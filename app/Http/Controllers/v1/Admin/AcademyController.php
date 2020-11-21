<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\Academy;

use Validator;

class AcademyController extends ApiController
{
    public function index(Request $request) {
        $page_size = $request->page_size;
        $datas= Academy::where('id', '>', 0);

        if ($request->has('search')) {
            $search = $request->search;
            $datas= $datas->where('name', 'like', '%'.$search.'%')
                ->orWhereHas('creator', function($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                });
        }   

        $datas = $datas->with('creator')->orderBy('id', 'desc')->paginate($page_size);

        return response()->json($datas);
    }   

    public function show($id) {
        $academy= Academy::with(['tags'])->findOrFail($id);

        return response()->json($academy);
    }

    public function store(Request $request) {
        $datas= $request->all();
        $datas['batch']= 1;
        $datas['tags']= explode(',', $datas['tags']);
        $datas['creator_id']= 1;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));

        if ($validator->fails()) {
            return response()->json([
                'fail' => false, 
                'message' => $validator->messages()
            ], 422);
        }

        $datas['url_name'] = str_replace(" ", "-", strtolower($datas['name']));
        $datas['url'] = url("/")."/academies/".$datas['url_name'];

        $upload = upload("/screen/medias/", $request->file('file'), '1');

        $datas['image_path'] = $upload;
        $datas['image_url'] = upload_dir().$upload;

        $academy= Academy::create($datas);
        $academy->tags()->attach($datas['tags']);
        $academy->save();

        if ($academy) {
            return response()->json([ 
                'tags' => $request->tags,
                'message' => 'academy created'
            ]);
        } else {
            return response()->json([
                "message" => "cant create academy"
            ], 400);
        }
    }

    public function update(Request $request, $id) {
        $datas= $request->all();
        $datas['updater_id'] = 1;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));

        if ($validator->fails()) {
            return response()->json([
                'fail' => false,
                'message' => $validator->messages()
            ], 422);
        }

        $datas['url_name'] = str_replace(" ", "-", strtolower($request->name));
        $datas['url'] = url("/")."/academies/".$datas['url_name'];

        $academy = Academy::findOrFail($id);
        $academy->update($datas);
        $academy->tags()->sync($datas['tags']);
        $academy->save();

        if ($academy) {
            return response()->json([
                'message' => 'academy updated'
            ]);
        } else {
            return response()->json([
                'message'=> 'cant update academy'
            ], 400);
        }
    }

    public function destroy(Request $request, $id) {
        $academy= Academy::findOrFail($id);

        if ($request->has('hard')) {
            if (filter_var(request()->hard, FILTER_VALIDATE_BOOLEAN)) {
                @unlink(base_upload_dir().$academy->image_path);
                
                $academy->tags()->detach();
                $academy->forceDelete();

                return response()->json([
                    'message' => 'academy deleted'
                ]);
            }
        }

        $academy->delete();
        $academy->save();
        
        return response()->json([
            'data' => $academy,
            'message' => 'academy deleted'
        ]);
    }
}
