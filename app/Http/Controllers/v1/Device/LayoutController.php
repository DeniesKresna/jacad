<?php

namespace App\Http\Controllers\v1\Device;

use App\Http\Controllers\ApiController;
use App\Models\DeviceSchedule;
use App\Models\Device;
use App\Models\LayoutBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class LayoutController extends ApiController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        if($request->has('imei')){
            $imei = $request->imei;
            $ip = $request->ip();
            $ua = $request->header('user_agent');

            //request with date and hour
            if($request->has('date') && $request->has('hour')){
                $dat = $request->date;
                $hou = intval($request->hour);
                if($hou < 10){
                    $hou = "0".$hou;
                }

                $tim = trim($dat)." ".trim($hou.":00:00");
                $prev_hour_start = date("Y-m-d H:00:00", strtotime($tim." -1 hour"));
                $prev_hour_end = date("Y-m-d H:00:00", strtotime($tim));

                $device_schedule = DeviceSchedule::where('imei',$imei)
                       ->where('created_at','>=',$prev_hour_start)
                        ->where('created_at','<=',$prev_hour_end)->orderBy('created_at')->value('data');
                if($device_schedule){
                    $dt = json_decode($device_schedule);
                    $res = DB::table('device_request_logs')->insert(['imei'=>$imei, 'description'=>'get list layout for '.$prev_hour_end,'created_at'=>date("Y-m-d H:i:s"), 'updated_at'=>date("Y-m-d H:i:s"),'ip'=>$ip,'user_agent'=>$ua]);
                    return response()->json($dt);
                }else{

                        $max_slot = 240;
                        //============get filler===================
                        $slotting_layout_boxes = LayoutBox::where('enable_slotting',1)->with('sequences','layout.device_lines')->get();
                        //=========================================
                        $device = DB::table('devices as d')->join('device_lines as dl','dl.device_id','=','d.id')
                                ->join('device_types as dt','dt.id','=','d.device_type_id')
                                ->join('layouts as l','l.id','=','dl.layout_id')
                                ->join('layout_boxes as lb','lb.layout_id','=','l.id')
                                ->where('lb.enable_slotting','>',0)
                                ->where('d.imei', $request->imei)
                                ->select("*","lb.id as lb_id","l.name as l_name","dt.name as type","dt.id as device_type_id","l.type as l_type","l.timeout as l_timeout")->first();
                        if(!$device){
                            return response()->json(["status"=>"not-ok","message"=>"imei ".$imei." is not registered"]);
                        }

                        $device->layout_boxes = Device::find($device->device_id)->device_line->layout->boxes;
                        $enable_slot_layout_box = LayoutBox::find($device->lb_id);
                        $device_type = $device->type;
                        $filler_content = DB::table('contents as co')
                                ->join('content_masters as cm','cm.id','=','co.content_master_id')
                                ->join('layout_sequences as ls','ls.content_master_id','=','cm.id')
                                ->join('layout_boxes as lb','ls.layout_box_id','=','lb.id')
                                ->where('lb.id',$device->lb_id)
                                ->where('co.type',$device->type)
                                ->select('co.*')
                                ->get();
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
                                        $device->slot[$i] = "no data or filler";
                                    }
                                }
                            }
                        }else{
                            for($i=0; $i<$max_slot; $i++) {
                                if(!isset($device->slot[$i])){
                                    $device->slot[$i] = "no data or filler";
                                }
                            }
                        }

                        //========================================

                        $array_list['nomorlayout'] = 1;
                        $array_list['layoutname'] = $device->l_name;
                        $array_list['starttime'] = $prev_hour_end;
                        $array_list['endtime'] = date("Y-m-d H:00:00", strtotime($prev_hour_end. " +1 hour"));
                        $tmp1['tvid'] = $device->imei;
                        $tmp1['layoutid'] = intval($hou);
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
                        $res = DB::table('device_request_logs')->insert(['imei'=>$imei, 'description'=>'get list layout for '.$prev_hour_end,'created_at'=>date("Y-m-d H:i:s"), 'updated_at'=>date("Y-m-d H:i:s"),'ip'=>$ip,'user_agent'=>$ua]);
                        return response()->json(["list"=>$arr,"status"=>"ok","wake"=>"07:00","sleep"=>"21:00","timerdownload"=>"900","timerestart"=>120,"maxsizelemma"=>"200","maxpendingdata"=>"75000"]);

                }
            }

            //--last version
            $next_hour_start = date("Y-m-d H:00:00");
            //$next_hour_start = date("Y-m-d H:00:00", strtotime($next_hour_start. " +1 hour"));
            $next_hour_end = date("Y-m-d H:00:00", strtotime($next_hour_start. " +1 hour"));

            $device_schedule = DeviceSchedule::where('imei',$imei)
                ->where('created_at','>=',$next_hour_start)->orderBy('created_at','desc')->value('data');
            if($device_schedule){
                $dt = json_decode($device_schedule);
                $res = DB::table('device_request_logs')->insert(['imei'=>$imei, 'description'=>'get list layout for '.$next_hour_end,'created_at'=>date("Y-m-d H:i:s"), 'updated_at'=>date("Y-m-d H:i:s"),'ip'=>$ip,'user_agent'=>$ua]);
                return response()->json($dt);
            }else{
                $max_slot = 240;
                //============get filler===================
                $slotting_layout_boxes = LayoutBox::where('enable_slotting',1)->with('sequences','layout.device_lines')->get();
                //=========================================
                $device = DB::table('devices as d')->join('device_lines as dl','dl.device_id','=','d.id')
                        ->join('device_types as dt','dt.id','=','d.device_type_id')
                        ->join('layouts as l','l.id','=','dl.layout_id')
                        ->join('layout_boxes as lb','lb.layout_id','=','l.id')
                        ->where('lb.enable_slotting','>',0)
                        ->where('d.imei', $request->imei)
                        ->select("*","lb.id as lb_id","l.name as l_name","dt.name as type","dt.id as device_type_id","l.type as l_type","l.timeout as l_timeout")->first();
                if(!$device){
                    return response()->json(["status"=>"not-ok","message"=>"imei ".$imei." is not registered"]);
                }

                $device->layout_boxes = Device::find($device->device_id)->device_line->layout->boxes;
                $enable_slot_layout_box = LayoutBox::find($device->lb_id);
                $device_type = $device->type;
                
                $filler_content = DB::table('contents as co')
                        ->join('content_masters as cm','cm.id','=','co.content_master_id')
                        ->join('layout_sequences as ls','ls.content_master_id','=','cm.id')
                        ->join('layout_boxes as lb','ls.layout_box_id','=','lb.id')
                        ->where('lb.id',$device->lb_id)
                        ->where('co.type',$device->type)
                        ->select('co.*')
                        ->get();

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
                                $device->slot[$i] = "no data or filler";
                            }
                        }
                    }
                }else{
                    for($i=0; $i<$max_slot; $i++) {
                        if(!isset($device->slot[$i])){
                            $device->slot[$i] = "no data or filler";
                        }
                    }
                }

                //========================================

                $array_list['nomorlayout'] = 1;
                $array_list['layoutname'] = $device->l_name;
                $array_list['starttime'] = $next_hour_end;
                $array_list['endtime'] = date("Y-m-d H:00:00", strtotime($next_hour_end. " +1 hour"));
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

                //DB::table('device_schedules')->where('imei',$device->imei)->where('created_at','<',DB::raw('NOW() - INTERVAL 1 DAY'))->delete();
                $res = DB::table('device_schedules')->insert($datas);
                if($res){
                    $device_schedule = DeviceSchedule::where('imei',$imei)
                        ->where('created_at','>',$next_hour_start)->orderBy('created_at')->value('data');
                    if($device_schedule){
                        $dt = json_decode($device_schedule);
                        $res = DB::table('device_request_logs')->insert(['imei'=>$imei, 'description'=>'get list layout for '.$next_hour_end,'created_at'=>date("Y-m-d H:i:s"), 'updated_at'=>date("Y-m-d H:i:s"),'ip'=>$ip,'user_agent'=>$ua]);
                        return response()->json($dt);
                    }
                    else{
                        return self::error_responses("Unknown error");
                    }
                }else{
                    return self::error_responses("Unknown error");
                }
            }
        }
        return response()->json(['message'=>"need Imei as parameter"]);
    }
}