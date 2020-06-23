<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\ApiController;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class MediaController extends ApiController
{
    public function store(Request $request){
        //$session_id = $request->get('auth')->user->id;
        $session_id=1;
        $validator = Validator::make($request->all(), rules_lists(__CLASS__, __FUNCTION__));
        if($validator->fails()) return self::error_responses($validator->messages());

        $media = $request->file('image');
        if (!empty($media)){
            $upload = upload("/screen/medias/posts/",$media,'1');
            $type = file_extension($upload);
            $datas['path'] = $upload;
            $datas['url'] = upload_dir().$upload;
            $tmp = explode("/", $upload);
            $datas['name'] = end($tmp);
            $datas['type'] = file_type($type);
            $datas["updater_id"] = $session_id;
            $res = Media::create($datas);
            if ($res){
                return response()->json(["url"=>$res->url]);
            } else {
                return response()->json(["message"=>"could not upload this image"],400);
            }
        } else {
            return response()->json(["message"=>"could not upload this image"],400);
        }
    }
}