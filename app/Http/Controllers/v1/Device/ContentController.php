<?php

namespace App\Http\Controllers\v1\Device;

use App\Http\Controllers\ApiController;
use App\Models\Content;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ContentController extends ApiController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function downloading(Request $request)
    {
        if($request->has('imei')){
        	$imei = $request->imei;
            $ip = $request->ip();
            $ua = $request->header('user_agent');
        	$device = DB::table('devices as d')->join('device_types as dt','dt.id','=','d.device_type_id')->join('device_lines as dl','d.id','=','dl.device_id')
        			->where('d.imei',$imei)->select("*","dt.name as type","dt.id as device_type_id")->first();
	        $array_list = [];
	        if($device){
	        	DB::table('devices')->where('id',$device->device_id)->update(['download_status'=>1]);
	        	//$time_content = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:00:00").'+1 hour'));
	        	$time_content = date('Y-m-d H:00:00');
	        	$time_content_end = date('Y-m-d H:i:s', strtotime($time_content.'+2 hour'));

		        //two line below used for development testing. delete if going to production.
		        /*
	            $time_content = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:00:00")));
	            $time_content_end = date('Y-m-d H:i:s', strtotime($time_content.'+1 hour'));
	            */

	        	/*-----------------------------------------------------------------------------
	        	| get all slots that reference to the device which has imei like the request data
	        	| and the slot time is interval one hour on the next hour.
	        	| and only take the list of the content id
				|-----------------------------------------------------------------------------*/
				$contents = DB::table('contents as ct')
							->join('content_masters as cm','cm.id','=','ct.content_master_id')
	        				->join('campaign_content_master as ccm','cm.id','=','ccm.content_master_id')
	        				->join('campaigns as c','c.id','=','ccm.campaign_id')
	        				->join('campaign_device_type as cdt','c.id','=','cdt.campaign_id')
	        				->join('campaign_location as cl','c.id','=','cl.campaign_id')
	        				->where("ct.type",$device->type)
	        				->where('cdt.device_type_id',$device->device_type_id)
	        				->where('cl.location_id',$device->location_id)
	        				->where('c.status',1)
                    		->where('c.end_date','>',$time_content)
                   			->where('c.start_date','<',$time_content_end)
	        				->groupBy('ct.id')
	        				->select('ct.*')
	        				->get();

	        	$guaranteeds = DB::table('contents as ct')
							->join('content_masters as cm','cm.id','=','ct.content_master_id')
	        				->join('content_master_guaranteed as gcm','cm.id','=','gcm.content_master_id')
	        				->join('guaranteeds as c','c.id','=','gcm.guaranteed_id')
	        				->join('device_type_guaranteed as cdt','c.id','=','cdt.guaranteed_id')
	        				->join('guaranteed_location as cl','c.id','=','cl.guaranteed_id')
	        				->where("ct.type",$device->type)
	        				->where('cdt.device_type_id',$device->device_type_id)
	        				->where('cl.location_id',$device->location_id)
                    		->where('c.end_date','>',$time_content)
                   			->where('c.start_date','<',$time_content_end)
	        				->groupBy('ct.id')
	        				->select('ct.*')
	        				->get();

	        	$filler_contents = DB::table('contents as ct')
							->join('content_masters as cm','cm.id','=','ct.content_master_id')
	        				->join('layout_sequences as ls', 'ls.content_master_id','=','cm.id')
	        				->join('layout_boxes as lb','ls.layout_box_id','=','lb.id')
	        				->join('layouts as l','l.id','=','lb.layout_id')
	        				->join('device_lines as dl','dl.layout_id','=','l.id')
	        				->where("ct.type",$device->type)
	        				->where('lb.enable_slotting',1)
	        				->where('dl.device_id',$device->device_id)
	        				->groupBy('ct.id')
	        				->select('ct.*')
	        				->get();

	        	foreach ($contents as $content) {
	        		$tmp['filename'] = $content->file_name;
	        		$tmp['urldownload'] = $content->file_url;
	        		array_push($array_list, $tmp);
	        	}
	        	foreach ($guaranteeds as $content) {
	        		$tmp['filename'] = $content->file_name;
	        		$tmp['urldownload'] = $content->file_url;
	        		array_push($array_list, $tmp);
	        	}
	        	foreach ($filler_contents as $content) {
	        		$tmp['filename'] = $content->file_name;
	        		$tmp['urldownload'] = $content->file_url;
	        		array_push($array_list, $tmp);
	        	}
	        }
	        $array_list2 = [];
	        foreach($array_list as $al){
	        	if(!$this->checkExistArrayByProperty($array_list2, "filename", $al['filename'])){
	        		array_push($array_list2, $al);
	        	}
	        }

	        $data["list"] = $array_list2;
	        $data["timezone"] = "Asia/Jakarta";
	        $data["timerestart"] = 120;
	        $data["timedownload"] = 30;
	        $data["password"] = "20200";

	        DB::table('device_request_logs')->insert(['imei'=>$imei, 'description'=>'downloading content','created_at'=>date("Y-m-d H:i:s"), 'updated_at'=>date("Y-m-d H:i:s"),'ip'=>$ip,'user_agent'=>$ua]);
	        return response()->json($data);
        }
        else{
        	return response()->json(['status'=>'not-ok','message'=>"need Imei as parameter"]);
        }
    }

    public function downloaded(Request $request)
    {
        if($request->has('imei')){
        	$imei = $request->imei;
            $ip = $request->ip();
            $ua = $request->header('user_agent');
        	$device = Device::where('imei',$imei)->firstOrFail();

        	if($device->download_status == 1){
        		$device->download_status = 0;
        		$device->save();
	        }
	        $data["status"] = "ok";
	        $data["message"] = "Update status completed !!!";

	        DB::table('device_request_logs')->insert(['imei'=>$imei, 'description'=>'download content finish','created_at'=>date("Y-m-d H:i:s"), 'updated_at'=>date("Y-m-d H:i:s"),'ip'=>$ip,'user_agent'=>$ua]);
	        return response()->json($data);
        }
        else{
        	return response()->json(['message'=>"need Imei as parameter"],422);
        }
    }

    private function checkExistArrayByProperty($arrs, $propName, $propVal){
    	foreach ($arrs as $arr) {
    		if($arr[$propName]==$propVal){
    			return true;
    		}
    	}
    	return false;
    }
}