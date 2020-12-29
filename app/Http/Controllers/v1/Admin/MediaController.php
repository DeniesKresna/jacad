<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Models\Media;

class MediaController extends ApiController {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $datas['updater_id']= 1;

        $validator= Validator::make($request->all(), rules_lists(__CLASS__, __FUNCTION__));

        if ($validator->fails()) {
            return response()->json(['message' => $validator->message()], 422);
        }

        if ($request->file('image')) {
            $upload = upload('/screen/medias/blogs-content/', $request->file('image'), '1');
            $temp_name= explode('/', $upload);

            $datas['name'] = end($temp_name);
            $datas['type'] = file_type(file_extension($upload));
            $datas['url'] = upload_dir().$upload;
            $datas['path'] = $upload;

            $media= Media::create($datas);

            if (!$media->save()) {
                return response()->json(['message' => 'Create media failed'], 500);
            }

            return response()->json(['url' => $media->url]);
        }  
    }
}