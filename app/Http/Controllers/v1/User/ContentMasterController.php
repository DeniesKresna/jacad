<?php

namespace App\Http\Controllers\v1\User;

use App\Http\Controllers\ApiController;
use App\Models\Campaign;
use App\Models\Content;
use App\Models\CampaignLocation;
use App\Models\CampaignContent;
use App\Models\ContentMaster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ContentMasterController extends ApiController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $session_id = $request->get('auth')->user->id;
        $page = !empty($request->page)?$request->page:1;
        $page_size = !empty($request->page_size)?$request->page_size:10;
        $datas = ContentMaster::with("contents")
            ->where('customer_id',$session_id)
            ->orderBy("id","desc")
            ->paginate($page_size,["*"],"page",$page);
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
        $session_id = request()->get('auth')->user->id;
        $data = ContentMaster::findOrFail($id);
        if($data->customer_id == $session_id)
            return self::success_responses($data->load("contents","playlists"));
        else
            return self::error_responses("This Content is not belonging to you");
    }

    public function store(Request $request)
    {
        $session_id = $request->get('auth')->user->id;

        $validator = Validator::make($request->all(), rules_lists(__CLASS__, __FUNCTION__));
        if ($validator->fails()) return self::error_responses($validator->messages());
        $content_master = ContentMaster::query()->create([
            "name" => $request->file_name,
            "description" => $request->file_description,
            "customer_id" => $session_id
        ]);
        if ($content_master) {
            $media_screen = $request->file('new_medias.screen');
            if (!empty($media_screen)) {
                $upload = upload("/screen/medias/", $media_screen, 'SCREEN');
                $datas['name'] = $request->file_name;
                $datas['description'] = $request->file_description;
                $datas['file_url'] = upload_dir() . $upload;
                $datas['file_path'] = $upload;
                $datas['type'] = "screen";
                $tmp = explode("/", $upload);
                $datas['file_name'] = end($tmp);
                $datas['content_master_id'] = $content_master->id;
                $datas["customer_id"] = $session_id;
                $content_screen = Content::create($datas);
                if (!$content_screen) {
                    $content_master->delete();
                    return self::error_responses("File screen failed to be upload");
                }
            } else {
                $content_master->delete();
                return self::error_responses("File screen failed to be upload");
            }
            $media_led = $request->file('new_medias.led');
            if (!empty($media_led)) {
                $upload = upload("/screen/medias/", $media_led, 'LED');
                $datas['name'] = $request->file_name;
                $datas['description'] = $request->file_description;
                $datas['file_url'] = upload_dir() . $upload;
                $datas['file_path'] = $upload;
                $datas['type'] = "led";
                $tmp = explode("/", $upload);
                $datas['file_name'] = end($tmp);
                $datas['content_master_id'] = $content_master->id;
                $datas["customer_id"] = $session_id;
                $content_led = Content::create($datas);
                if (!$content_led) {
                    @unlink(upload_dir() . $content_screen->file_path);
                    $content_screen->delete();
                    $content_master->delete();
                    return self::error_responses("File led failed to be upload");
                }
            } else {
                @unlink(upload_dir() . $content_screen->file_path);
                $content_screen->delete();
                $content_master->delete();
                return self::error_responses("File led failed to be upload");
            }
            return self::success_responses($content_master);
        }
    }

    public function update(Request $request, $id){
        $res = ContentMaster::findOrFail($id);
        $session_id = $request->get('auth')->user->id;
        $datas["customer_id"] = $session_id;
        if($res->customer_id == $session_id){
            $res->update($request->all());
        } else {
            return self::error_responses("This Content is not belonging to you");
        }
    }

    public function destroy($id){
        $res = ContentMaster::findOrFail($id);
        $session_id = request()->get('auth')->user->id;
        if($res->customer_id == $session_id){
            $res->delete();
            return self::success_responses("Success delete content");
        }
        else
            return self::error_responses("This Content is not belonging to you");
    }
}