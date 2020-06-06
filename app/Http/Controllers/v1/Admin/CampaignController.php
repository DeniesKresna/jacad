<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\ApiController;
use App\Models\Campaign;
use App\Models\Device;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\CampaignConfirmation;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Traits\Slotting;

class CampaignController extends ApiController
{
    use Slotting;
    public function index(Request $request)
    {
        $page = !empty($request->page)?$request->page:1;
        $page_size = !empty($request->page_size)?$request->page_size:10;
        $datas = Campaign::where('id','>',0);
        if($request->has('status')){
            $datas = $datas->where('status',$request->status);
        }
        if($request->has('trashed')){
            if(filter_var($request->trashed, FILTER_VALIDATE_BOOLEAN)){
                $datas = $datas->withTrashed();
            }
        }

        $datas = $datas->orderBy("id","desc")->with('customer',"campaign_summary", 'verificator','locations', 'content_masters', 'device_types')->paginate($page_size,["*"],"page",$page);

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
        if(request()->has('trashed')){
            if(filter_var(request()->trashed, FILTER_VALIDATE_BOOLEAN)){
                $data =Campaign::with("customer", "verificator","locations","content_masters","device_types")->withTrashed()->findOrFail($id);
            }
            else{
                $data = Campaign::with("customer", "verificator","locations","content_masters","device_types")->findOrFail($id);
            }
        }
        else{
            $data = Campaign::with("customer", "verificator","locations","content_masters","device_types")->findOrFail($id);
        }
        return self::success_responses($data);
    }

    public function store(Request $request){
        $datas = $request->all();
        $datas["status"] = 1;
        $datas["priority"] = 1;
        $session_id = $request->get('auth')->user->id;
        $datas["verificator_id"] = $session_id;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        if($validator->fails()) return self::error_responses($validator->messages());

        if(strtotime(date("Y-m-d H:i:s")) >= strtotime(date("Y-m-d H:00:00", strtotime($datas['start_date']. " -1 hour")))){
            return self::error_responses("campaign creation time should be more than one hour before the campaign starts");
        }
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

        $available_slot = $this->get_available_slot($datas['start_date'],$datas['end_date'],$datas['locations'],$datas['device_types']);

        if($available_slot >= $datas['slots']){
            $res = Campaign::create($datas);
            if ($res){
                //insert new medias
                if (!empty($new_medias))
                    $medias = to_object(array_merge(to_array($medias),to_array($this->insert_media($new_medias,$datas["customer_id"],$datas['file_name'],$datas['file_description']))));

                $res->device_types()->attach($device_types);
                $res->locations()->attach($locations);
                $res->content_masters()->sync($medias);

                return self::success_responses($res->load("customer","verificator","locations","content_masters","device_types"));
            } else {
                return self::error_responses("Unknown error");
            }
        }else{
            return self::error_responses("Some slots have been booked. Please rearrange your slot again.");
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
        $res = Campaign::findOrFail($id);
        $session_id = $request->get('auth')->user->id;
        
        if($request->has('status') && $res->status==0){
            if($request->status == '1'){
                if(strtotime(date("Y-m-d H:i:s")) >= strtotime(date("Y-m-d H:00:00", strtotime($res->start_date. " -1 hour")))){
                    return self::error_responses("campaign approval time should be more than one hour before the campaign starts");
                }
                $res->status = '1';
            }
            else{
                $res->status = '2';
            }
            $res->verificator_id = $session_id;
            if($res->save()){
                //Notification::send($res->customer, new CampaignConfirmation($request->status));
                return self::success_responses($res->load("customer", "verificator","locations","content_masters","device_types"));
            } else {
                return self::error_responses("Unknown error");
            }
        }
        else
            return self::error_responses("Need status parameter or this campaign has been verified by admin");
    }

    public function destroy($id){
        //if hard delete
        if(request()->has('hard')){
            if(filter_var(request()->hard, FILTER_VALIDATE_BOOLEAN)){
                $res = Campaign::withTrashed()->findOrFail($id);
                if($res){
                    $res->locations()->detach();

                    $res->content_masters()->detach();

                    $res->device_types()->detach();

                    $res->forceDelete();
                    return self::success_responses();
                }
            }
        }
        // if soft delete
        $res = Campaign::findOrFail($id)->delete();
        return self::success_responses();
    }


    //================= 2019 phase ===============

    public function summary(Request $request){
        if($request->has('start_time'))
            $start_time = date("Y-m-d H:i:s", strtotime($request->start_time));
        else
            $start_time = date("Y-m-d H:i:s");

        if($request->has('end_time'))
            $end_time = date("Y-m-d H:i:s", strtotime($request->end_time));
        else
            $end_time = date("Y-m-d H:i:s");
        
        $validator = Validator::make($request->all(), rules_lists("Global","any"));
        if($validator->fails()) return self::error_responses($validator->messages());

        $campaigns = DB::table('campaign as c')->join('campaign_summaries as cs','cs.campaign_id','=','c.id')
                    ->where('dt','>=',$start_time)
                    ->where('dt','<=',$end_time)
                    ->selectRaw('c.*, sum(cs.total_air_time) as online, sum(cs.dst) as distance')
                    ->groupBy('cs.campaign_id')->get();
        return self::success_responses($campaigns);
    }

    public function summaryDetail($id, $campaign_id, $campaign_device){
        
    }
    //==============
}