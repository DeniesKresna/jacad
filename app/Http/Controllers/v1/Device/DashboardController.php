<?php

namespace App\Http\Controllers\v1\Device;

use App\Http\Controllers\ApiController;
use App\Models\Device;
use Illuminate\Http\Request;
use Validator;

class DashboardController extends ApiController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->has('imei')){
        	$imei = $request->imei;
	        $device = Device::where('imei',$imei)->first();
	        if($device){
                $tolerance_in_minute = 5;
                $device->total_distance = $device->total_distance + $this->distance($device->last_lat, $device->last_lng, $request->lat, $request->lon, "K");
                $device->last_lat = $request->lat;
                $device->last_lng = $request->lon;
                $device->screen_status = $request->power;
                $device->monitor = $request->screen;
                $device->app_version = $request->versionname;
                $last_time = strtotime($device->last_gps_time);
                $device->last_gps_time = date("Y-m-d H:i:s");
                $now_time = strtotime($device->last_gps_time);
                if($now_time - $last_time <= $tolerance_in_minute * 60){
                    $device->total_screen_time = $device->total_screen_time + ($now_time - $last_time);
                }else{
                    $device->last_screen_off_time = date("Y-m-d H:i:s", $last_time);
                }
                $device->save();
		        if($device->download_status == 1){
		          $download = "downloading";
		        }
		        else{
		        		$download = "downloaded";
		        }
	        	$datas['tvid'] = strtolower($imei);
	        	$datas['status'] = "ok";
	        	$datas['download'] = $download;
	        	$datas['password'] = 20200;
	        	$datas['message'] = [];
        		return response()->json($datas);
        	}
        	else{
        		return response()->json(["status"=>"not-ok","message"=>"imei ".$imei." is not registered"]);
        	}
        }
        return response()->json(["status"=>"not-ok","message"=>"need imei as parameter"]);
    }

    private function distance($lat1, $lon1, $lat2, $lon2, $unit){
          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
          $unit = strtoupper($unit);

          if ($unit == "K") {
              return ($miles * 1.609344);
          } else if ($unit == "N") {
              return ($miles * 0.8684);
          } else {
              return $miles;
          }
    }
}
//if(filter_var(request()->trashed, FILTER_VALIDATE_BOOLEAN)){