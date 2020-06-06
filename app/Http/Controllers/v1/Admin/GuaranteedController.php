<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\ApiController;
use App\Models\Guaranteed;
use App\Models\CampaignDeviceType;
use App\Models\Content;
use App\Models\Location;
use App\Models\DeviceType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Traits\Slotting;
use Illuminate\Support\Facades\DB;

class GuaranteedController extends ApiController
{
    use Slotting;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $auth = $request->get('auth');
        $page = !empty($request->page)?$request->page:1;
        $page_size = !empty($request->page_size)?$request->page_size:10;
        $datas = Guaranteed::orderBy("id","desc")->with('verificator', 'locations', 'content_masters', 'device_types')->paginate($page_size,["*"],"page",$page);

        $data = [
            "total"=>$datas->total(),
            "page_size"=>$datas->perPage(),
            "page"=>$datas->currentPage(),
            "result"=>$datas->items(),
            "previous_page_url" => $datas->previousPageUrl(),
            "next_page_url" => $datas->nextPageUrl(),
        ];
        return self::success_responses($data);
    }

    public function show($id)
    {
        $data = Guaranteed::withTrashed()->with("verificator","locations","content_masters","device_types")->findOrFail($id);
        return self::success_responses($data);
        
    }

    public function store(Request $request){
        $datas = $request->all();
        $session_id = $request->get('auth')->user->id;
        $datas['verificator_id'] = $session_id;
        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        if($validator->fails()) return self::error_responses($validator->messages());

/*
        if(strtotime(date("Y-m-d H:i:s")) >= strtotime(date("Y-m-d H:00:00", strtotime($datas['start_date']. " -1 hour")))){
            return self::error_responses("campaign creation time should be more than one hour before the campaign starts");
        }*/
        //blank option on locations and device_types
        if($request->locations){
            if(is_array($request->locations)){
                if(count($request->locations) == 0)
                    $locations = Location::where('id' ,'>' ,0)->pluck('id')->toArray();
                else
                    $locations = $request->locations;
            }
            else
                $locations = Location::where('id' ,'>' ,0)->pluck('id')->toArray();
        }
        else
            $locations = Location::where('id' ,'>' ,0)->pluck('id')->toArray();

        if($request->device_types){
            if(is_array($request->device_types)){
                if(count($request->device_types) == 0)
                    $device_types = DeviceType::where('id','>',0)->pluck('id')->toArray();
                else
                    $device_types = $request->device_types;
            }
            else
                $device_types = DeviceType::where('id','>',0)->pluck('id')->toArray();
        }
        else
            $device_types = DeviceType::where('id','>',0)->pluck('id')->toArray();

        $medias = $request->medias;
        $new_medias = Input::file('new_medias');
        
        if((count($medias) == 0) && !$new_medias){
            return self::error_responses("Need minimum 1 media");
        }
        //set medias to empty array on null medias.
        //i dont know why in postman if there is media request with null data, the laravel array
        //has one element with null data inside it. so i reset the array if first element is null.
        //i cant ignore with uncheck the request in postman coz the frontend send it.
        if(!$medias[0])
            $medias = [];

        $available = $this->get_available_guaranteed($datas['start_date'],$datas['end_date'],$datas['locations'],$datas['device_types']);

        if($available){
            $res = Guaranteed::create($datas);
            if ($res){
                //insert new medias
                if (!empty($new_medias))
                    $medias = to_object(array_merge(to_array($medias),to_array($this->insert_media($new_medias,$session_id,$datas['file_name'],$datas['file_description']))));

                $res->device_types()->attach($device_types);
                $res->locations()->attach($locations);
                $res->content_masters()->sync($medias);

                return self::success_responses($res->load("verificator","locations","content_masters","device_types"));
            } else {
                return self::error_responses("Unknown error");
            }
        }else{
            return self::error_responses("A guaranteed slot has been booked at that time.");
        }
    }

    public function insert_media($new_medias,$user_id,$file_name,$file_description){
        $inserted = [];
        $i = 1;
        foreach ($new_medias as $key => $new_media){           
            if (!empty($new_media)){
                $upload = upload("/screen/medias/",$new_media, $i);
                $type = file_extension($upload);
                $data['name'] = $file_name[$key];
                $data['description'] = $file_description[$key];
                $data['file_url'] = upload_dir().$upload;
                $data['file_path'] = $upload;
                $tmp = explode("/", $upload);
                $data['file_name'] = end($tmp);
                $data['type'] = file_type($type);
                $data['customer_id'] = $user_id;
                $res = Content::query()->create($data);
                array_push($inserted,$res->id);
                $i++;
            }
        }
        return $inserted;
    }

    public function update($id,Request $request){
        $datas = $request->all();
        $session_id = $request->get('auth')->user->id;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        if($validator->fails()) return self::error_responses($validator->messages());
        
        $datas = exclude_array($datas,['name']);
        $res = Guaranteed::findOrFail($id);

        $res->update($datas);
        if ($res){
            return self::success_responses($res->load("verificator","locations","content_masters","device_types"));
        } else {
            return self::error_responses("Unknown error");
        }
    }

    public function destroy($id, Request $request){
        //if hard delete
        if(request()->has('hard')){
            if(filter_var(request()->hard, FILTER_VALIDATE_BOOLEAN)){
                $res = Guaranteed::withTrashed()->findOrFail($id);
                if($res){
                    $res->locations()->detach();

                    /*
                    $media_paths = $res->contents()->pluck('file_path');
                    foreach ($media_paths as $media_path) {
                        @unlink(base_upload_dir().$media_path);
                    }
                    $res->contents()->delete();
                    */

                    $res->content_masters()->detach();

                    $res->device_types()->detach();

                    $res->forceDelete();
                    return self::success_responses();
                }
            }
        }
        // if soft delete
        $res = Guaranteed::findOrFail($id)->delete();
        return self::success_responses();
    }

    public function check_available_guaranteed(Request $request){
        $data = $request->all();

        $available_slot = $this->get_available_guaranteed($data['start_date'],$data['end_date'],$data['locations'],$data['device_types']);

        return self::success_responses($available_slot);
    }
}