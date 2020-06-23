<?php

namespace App\Http\Controllers\v1\Device;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Guaranteed;
use App\Models\Device;
use App\Models\DeviceSchedule;
use App\Models\LayoutBox;
use App\Models\SlotImpression;
use Illuminate\Support\Facades\DB;
use App\Traits\Slotting;

class SlotController extends ApiController
{
    use Slotting;
    //
    public function played(Request $request){
        $data = $request->all();
        $raw_id = DB::table('slot_raws')
            ->insertGetId([
                'imei'=>$request->device_id, 
                'data'=>json_encode($request->data), 
                'created_at'=>date("Y-m-d H:i:s"), 
                'updated_at'=>date("Y-m-d H:i:s")
            ]);
        $device = DB::table('devices')
            ->where('imei',$request->device_id)
            ->first();
        $device_line = false;
        if($device) {
            $device_line = DB::table('device_lines')
                ->where('device_id',$device->id)
                ->first();

            //update last gps time       
            if($device_line){
                $res = DB::table('devices')->where('id',$device->id)->update([
                    'last_gps_time'=>date("Y-m-d H:i:s")
                ]);
            }     
        }
        if($raw_id){
            foreach($data['data'] as $dt){
                if(isset($dt['idmedia']) && isset($dt['idcampaign']) && isset($dt['idguaranteed']) && isset($dt['starttime']) && isset($dt['endtime'])){
                    $slot_impression = DB::table('slot_impressions')
                            ->where('imei',$request->device_id)
                            ->where('content_id',$dt['idmedia'])
                            ->where('campaign_id',$dt['idcampaign'])
                            ->where('guaranteed_id',$dt['idguaranteed'])
                            ->where('play_start_time',$dt['starttime'])
                            ->where('play_end_time',$dt['endtime'])
                            ->first();
                }else{
                    return self::error_responses("need latest apk");
                }
                if(!$slot_impression){
                    $imp_id = DB::table('slot_impressions')->insertGetId(
                        [
                            'imei'=>$data['device_id'], 
                            'content_id'=>$dt['idmedia'], 
                            'device_id'=>$device?$device->id:0, 
                            'device_line_id'=>$device_line?$device_line->id:0, 
                            'campaign_id'=>$dt['idcampaign'], 
                            'guaranteed_id'=>$dt['idguaranteed'],
                            'play_start_time'=>$dt['starttime'], 
                            'play_end_time'=>$dt['endtime'],
                            'calculated_status'=>1,
                            'guaranteed'=>$dt['guaranteed'],
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s')
                        ]
                    );
                    if($imp_id){
                        //if the played slot is campaign no guaranteed
                        if($dt['guaranteed']==0){
                            $cs_sp = DB::table('campaign_summaries')->where('campaign_id',$dt['idcampaign'])->orderBy('created_at','desc')->value('slot_played');
                            $res2 = false;
                            if($cs_sp){
                                $cs_sp = intval($cs_sp) + 1;
                                $res2 = DB::table('campaign_summaries')->where('campaign_id',$dt['idcampaign'])->update(['slot_played'=>$cs_sp]);       
                            }
                            else{
                                $res2 = DB::table('campaign_summaries')->insert([
                                    'campaign_id'=>$dt['idcampaign'],
                                    'slot_played'=>1,
                                    'created_at'=>date("Y-m-d H:i:s"),
                                    'updated_at'=>date("Y-m-d H:i:s"),
                                ]);
                            }
                            if(!$res2){
                                DB::table('slot_impressions')->where('id',$imp_id)
                                    ->update(['calculated_status'=>0]);
                            }
                        }
                    }else{
                        DB::table('slot_raws')->where('id',$raw_id)->delete();
                        return response()->json(['status'=>'not-ok']);
                    }
                }
            }
        }
        return response()->json(['status'=>'ok']);
    }

    public function generate(){
        $next_hour_start = date("Y-m-d H:00:00", strtotime(date("Y-m-d H:i:s")." +1 hour"));
        $next_hour_end = date("Y-m-d H:00:00", strtotime($next_hour_start. " +1 hour"));

        //make sure device schedule generated once
        /*
        $device_schedule = DeviceSchedule::orderBy('created_at','desc')->first();
        if($device_schedule){
            $last_device_schedule_hour = date("Y-m-d H:00:00", strtotime($device_schedule->created_at."+1 hour"));
            if($last_device_schedule_hour == $next_hour_start){
                return self::success_responses("slot has been created on last generate");
            }
        }*/
        
        //delete schedule from this floor time
        DB::table('device_schedules')->where('created_at','>=',date("Y-m-d H:00:00"))->delete();
        
        //get device online
        $devices = DB::table('devices as d')->join('device_lines as dl','dl.device_id','=','d.id')
                        ->join('device_types as dt','dt.id','=','d.device_type_id')
                        ->join('layouts as l','l.id','=','dl.layout_id')
                        ->join('layout_boxes as lb','lb.layout_id','=','l.id')
                        ->where('lb.enable_slotting','>',0)
                        ->where('d.last_gps_time','>',DB::raw('NOW() - INTERVAL 5 MINUTE'))
                        ->groupBy('dl.id')
                        ->orderBy('dl.id')
                        ->select("*","lb.id as lb_id","l.name as l_name","dt.name as type","dt.id as device_type_id","l.type as l_type","l.timeout as l_timeout")
                        ->get();
        if(count($devices) == 0){
            return self::error_responses("No Device is available");
        }

        //get campaign used
        $campaigns = DB::table('campaigns as c')
                    ->leftJoin('campaign_summaries as cs','c.id','=','cs.campaign_id')
                    ->select(DB::raw('c.*,(c.slots - SUM(cs.slot_played)) as slot_unplayed'))
                    ->groupBy('c.id')
                    ->where('c.status',1)
                    ->where('c.start_date','<=',$next_hour_start)
                    ->where('c.end_date','>=',$next_hour_end)
                    ->orderBy('c.id')->get();


        //FOR GUARANTEED
        $guaranteeds = DB::table('guaranteeds as g')
                    ->where('g.start_date','<=',$next_hour_start)
                    ->where('g.end_date','>=',$next_hour_end)
                    ->orderBy('g.id')->get();

        //check if no campaign or guaranteed
        if(count($campaigns) == 0 && count($guaranteeds) == 0 ){
            return self::error_responses("No Campaign is available");
        }

        //fill device property with guaranteed
        if(count($guaranteeds) > 0){
            foreach($guaranteeds as $guaranteed){
                $max_slot = 240;
                $guaranteed->locations = DB::table('guaranteed_location')->where('guaranteed_id',$guaranteed->id)->pluck('location_id')->toArray();
                $guaranteed->device_types = DB::table('device_type_guaranteed')->where('guaranteed_id',$guaranteed->id)->pluck('device_type_id')->toArray();
                $ctn = DB::table('contents as co')->join('content_masters as cm','cm.id','=','co.content_master_id')->join('content_master_guaranteed as gcm','cm.id','=','gcm.content_master_id')->where('gcm.guaranteed_id',$guaranteed->id)->get();
                $guaranteed->contents = $ctn;
                //$guaranteed->contents = Guaranteed::find($guaranteed->id)->contents;
                //

                $device_match = [];
                foreach ($devices as $device) {
                    if(in_array($device->location_id, $guaranteed->locations) && in_array($device->device_type_id, $guaranteed->device_types)){
                        array_push($device_match, $device);
                    }
                }

                if(count($device_match)>0){
                    foreach ($device_match as $device) {
                        $booked_slot = ['guaranteed_id'=>$guaranteed->id, 'slot'=>$max_slot];
                        $device->gtd = true;
                        if(isset($device->booked)){
                            array_push($device->booked, $booked_slot);
                        }else{
                            $device->booked[0] = $booked_slot;
                        }
                    }
                }
            }
        }

        //fill device property with campaign
        if(count($campaigns) > 0){
            foreach($campaigns as $campaign){
                //set campaign additional data
                $max_slot = 240;
                if(!$campaign->slot_unplayed){
                    $campaign->slot_unplayed = $campaign->slots;
                }
                if($campaign->slot_unplayed <= 0){
                    continue;
                }
                $campaign->locations = DB::table('campaign_location')->where('campaign_id',$campaign->id)->pluck('location_id')->toArray();
                $campaign->device_types = DB::table('campaign_device_type')->where('campaign_id',$campaign->id)->pluck('device_type_id')->toArray();                
                $ctn = DB::table('contents as co')->join('content_masters as cm','cm.id','=','co.content_master_id')->join('campaign_content_master as ccm','cm.id','=','ccm.content_master_id')->where('ccm.campaign_id',$campaign->id)->get();
                $campaign->contents = $ctn;
                //

                $device_match = [];
                foreach ($devices as $device) {
                    if(in_array($device->location_id, $campaign->locations) && in_array($device->device_type_id, $campaign->device_types)){
                        if(!property_exists($device, 'gtd')){
                            array_push($device_match, $device);
                        }
                    }
                }

                if(count($device_match)>0){
                    $campaign_sd = $next_hour_start;
                    $campaign_ed = date("Y-m-d H:00:00", strtotime($campaign->end_date));
                    $total_hour = $this->block_hour($campaign_sd, $campaign_ed, $campaign->locations, $campaign->device_types);
                    $booked = intval(ceil($campaign->slot_unplayed / ($total_hour*count($device_match))));
                    if($booked > $max_slot) $booked = $max_slot;
                    foreach ($device_match as $device) {
                        $real_booked = $booked;
                        if(isset($device->remaining_slot)){
                            if($device->remaining_slot > 0){
                                if($device->remaining_slot>=$real_booked){
                                    $device->remaining_slot -= $real_booked;
                                }else{
                                    $real_booked = $device->remaining_slot;
                                    $device->remaining_slot = 0;
                                }
                            }else{
                                continue;
                            }
                        }else{
                            $device->remaining_slot = $max_slot-$real_booked;
                        }

                        $booked_slot = ['campaign_id'=>$campaign->id, 'slot'=>$real_booked];

                        if(isset($device->booked)){
                            array_push($device->booked, $booked_slot);
                        }else{
                            $device->booked[0] = $booked_slot;
                        }
                    }
                }
            }
        }

        //================================= get filler of all layoutbox id===================
        $slotting_layout_boxes = [];
        foreach($devices as $device){
            $flag = true;
            foreach($slotting_layout_boxes as $slotting_layout_box){
                if($slotting_layout_box->lb_id == $device->lb_id){
                    $flag = false;
                    break;
                }
            }
            if($flag){
                $obj = new \stdClass();
                $obj->lb_id = $device->lb_id;
                array_push($slotting_layout_boxes, $obj);
            }
        }

        foreach ($slotting_layout_boxes as $slotting_layout_box) {
            $ctn = DB::table('contents as co')
                    ->join('content_masters as cm','cm.id','=','co.content_master_id')
                    ->join('layout_sequences as ls','ls.content_master_id','=','cm.id')
                    ->join('layout_boxes as lb','ls.layout_box_id','=','lb.id')
                    ->where('lb.id',$slotting_layout_box->lb_id)
                    ->select('co.*')
                    ->get();
            $slotting_layout_box->contents = $ctn;
        }
        //====================================================================================

        $device_schedule_data = [];
        foreach ($devices as $device) {
            $device_type = $device->type;
            $device->slot = array_fill(0, 240, null);
            $device->layout_boxes = Device::find($device->device_id)->device_line->layout->boxes;
            //$device->slot = [];
            if(!isset($device->booked)){
                continue;
            }
            usort($device->booked, function($a, $b) {return $a['slot']>$b['slot'];});
            foreach($device->booked as $book){
                $gtd = 0;
                if(property_exists($device, "gtd")){
                    $gtd = 1;
                    $campaign = $this->get_object_from_array($guaranteeds, 'id', $book['guaranteed_id']);
                }else{
                    $campaign = $this->get_object_from_array($campaigns, 'id', $book['campaign_id']);
                }
                $multiple_index = intval(round($max_slot / $book['slot']));
                //$multiple_index = count($device->booked);
                $ctns = $campaign->contents;

                $filtered_ctns = [];
                foreach ($ctns as $ctn) {
                    if($ctn->type == $device_type){
                        array_push($filtered_ctns, $ctn);
                    }
                }
                $campaign->contents=$filtered_ctns;

                $cmp_content_amount = count($campaign->contents);
                $cmp_counter = 0;
                $walking_counter = 0;
                while($cmp_counter < $book['slot']){
                    $walking_counter %= $max_slot;
                    if(isset($device->slot[$walking_counter])){
                        $walking_counter++;
                        continue;
                    }else{
                        $content = $campaign->contents[$cmp_counter % $cmp_content_amount];
                        $tmp = [];
                        $tmp['sequenceno'] = $walking_counter;
                        $tmp['idmedia'] = $content->id;
                        $tmp['typedata'] = $content->type;
                        $tmp['filename'] = $content->file_name;
                        $tmp['labeltext'] = $content->name;
                        if($gtd==0){
                            $tmp['campaign_id'] = $campaign->id;
                        }else{
                            $tmp['campaign_id'] = 0;
                        }
                        if($gtd==1){
                            $tmp['guaranteed_id'] = $campaign->id;
                        }else{
                            $tmp['guaranteed_id'] = 0;
                        }
                        $tmp['guaranteed'] = $gtd;
                        $tmp['status'] = "aktif";

                        $device->slot[$walking_counter] = $tmp;

                        $walking_counter += $multiple_index;
                        $cmp_counter++;
                    }
                }
            }

            //put filler content
            $filler_content = null;
            foreach ($slotting_layout_boxes as $slotting_layout_box) {
                if($device->lb_id == $slotting_layout_box->lb_id){
                    $filler_content = $slotting_layout_box->contents;
                    $filtered_ctns = [];
                    foreach ($filler_content as $ctn) {
                        if($ctn->type == $device_type){
                            array_push($filtered_ctns, $ctn);
                        }
                    }
                    $filler_content = $filtered_ctns;
                    break;
                }
            }
            //return response()->json($filler_content);
            if($filler_content){
                if(count($filler_content) > 0){
                    $filler_counter = 0;
                    $filler_content_amount = count($filler_content);
                    for($i=0; $i<$max_slot; $i++) {
                        if(!isset($device->slot[$i])){
                            $content = $filler_content[$filler_counter % $filler_content_amount];
                            $tmp['sequenceno'] = $i;
                            $tmp['idmedia'] = $content->id;
                            $tmp['typedata'] = $content->type;
                            $tmp['filename'] = $content->file_name;
                            $tmp['labeltext'] = $content->name;
                            $tmp['campaign_id'] = 0;
                            $tmp['guaranteed_id'] = 0;
                            $tmp['guaranteed'] = 0;
                            $tmp['status'] = "aktif";

                            $device->slot[$i] = $tmp;
                            $filler_counter++;
                        }
                    }
                }else{
                    for($i=0; $i<$max_slot; $i++) {
                        if(!isset($device->slot[$i])){
                            $device->slot[$i] = "no data or use filler";
                        }
                    }
                }
            }else{
                for($i=0; $i<$max_slot; $i++) {
                    if(!isset($device->slot[$i])){
                        $device->slot[$i] = "no data or use filler";
                    }
                }
            }

            //========================================

            $array_list['nomorlayout'] = 1;
            $array_list['layoutname'] = $device->l_name;
            $array_list['starttime'] = $next_hour_start;
            $array_list['endtime'] = $next_hour_end;
            $tmp1['tvid'] = $device->imei;
            $tmp1['layoutid'] = intval(date("H", strtotime(date("Y-m-d H:00:00"). " +1 hour")));
            $tmp1['layoutname'] = $device->l_name;
            $tmp1['layouttype'] = $device->l_type;
            $tmp1['timerlayout'] = $device->l_timeout;
            $tmp1['layoutdetail'] = [];
            $array_list['layout'] = $tmp1;

            foreach($device->layout_boxes as $layout_box){
                if($layout_box->lemma_publisher_id==null){
                    $layout_box->lemma_publisher_id = 0;
                }
                if($layout_box->lemma_ads_unit_id==null){
                    $layout_box->lemma_ads_unit_id = 0;
                }
                $tmp2['idlayout'] = $layout_box->id;
                $tmp2['boxno'] = $layout_box->box_number;
                $tmp2['typetemplate_detail'] = $layout_box->data_type;
                $tmp2['publisher_id'] = $layout_box->lemma_publisher_id;
                $tmp2['addunitid'] = $layout_box->lemma_ads_unit_id;
                $tmp2['width'] = $layout_box->width;
                $tmp2['height'] = $layout_box->height;
                $tmp2['below'] = $layout_box->below;
                $tmp2['rightof'] = $layout_box->right_of;
                $tmp2['leftof'] = $layout_box->left_of;
                $tmp2['fontsize'] = $layout_box->font_size;
                $tmp2['periode'] = $layout_box->timeout;
                $tmp2['sequencemedia'] = [];
                if($layout_box->enable_slotting == 1){
                    $tmp2['sequencemedia'] = $device->slot;
                }
                array_push($array_list['layout']['layoutdetail'],$tmp2);
            }

            $arr[0] = $array_list;
            $datas = ['imei'=>$device->imei, 'data'=>json_encode(["list"=>$arr,"status"=>"ok","wake"=>"07:00","sleep"=>"21:00","timerdownload"=>"900","timerestart"=>120,"maxsizelemma"=>"200","maxpendingdata"=>"75000"]), 'created_at'=>date("Y-m-d H:i:s"), 'updated_at'=>date("Y-m-d H:i:s")];
            array_push($device_schedule_data, $datas);
        }

        //DB::table('device_schedules')->where('created_at','<',DB::raw('NOW() - INTERVAL 1 DAY'))->delete();
        if(count($device_schedule_data)>0){
            $res = DB::table('device_schedules')->insert($device_schedule_data);
            if($res){
                return self::success_responses("generate slot schedule success");
            }else{
                return self::error_responses("Unknown error");
            }
        }else{
            return self::success_responses("no schedule is made");
        }
    }

    private function get_object_from_array($arrayObject, $pivotColumn, $pivotData){
        foreach ($arrayObject as $obj) {
            if($obj->{$pivotColumn} == $pivotData)
                return $obj;
        }
    }

    private function array_object_operation($arrayObject, $column, $mode){
        $returnData = 0;
        if($mode == "sum"){
            foreach ($arrayObject as $obj){
                $returnData += $obj->{$column};
            }
        }
        return $returnData;
    }
}
