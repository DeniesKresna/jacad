<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Models\Academy;

class AcademyController extends ApiController {   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $page= $request->page;
        $page_size = $request->page_size;
        $search= $request->search;

        $academies= Academy::with('creator')
            ->when($request->has('search') && $search, function($query) use ($search) {
                $query->where('name', 'LIKE', '%'.$search.'%')
                      ->orWhereHas('creator', function($query) use ($search) {
                        $query->where('users.name', 'LIKE', '%'.$search.'%');
                    });
            })
            ->orderBy('id', 'DESC')
            ->paginate($page_size);

        return response()->json($academies);
    }
    
    public function list() {
        $academies= Academy::orderBy('name')->get();

        return response()->json($academies);
    }

    public function show($id) {
        $academy= Academy::with(['tags'])->findOrFail($id);

        return response()->json($academy);
    }

    public function store(Request $request) {
        $datas= $request->all();
        $datas['tags']= json_decode($datas['tags']);
        $datas['creator_id']= 1;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        $datas['url_name'] = str_replace(' ', '-', strtolower($datas['name']));
        $datas['url'] = url('/').'/academies/'.$datas['url_name'];

        $upload = upload('/screen/medias/', $request->file('image'), '1');

        $datas['image_path'] = $upload;
        $datas['image_url'] = upload_dir().$upload;

        $academy= Academy::create($datas);
        $academy->tags()->attach($datas['tags']);

        if (!$academy->save()) {
            return response()->json(['message' => 'Create academy failed']);
        }

        return response()->json(['message' => "Academy {$academy->name} created!"]);
    }

    public function update(Request $request, $id) {
        $datas= $request->all();
        $datas['tags']= json_decode($datas['tags']);
        $datas['updater_id'] = 1;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        $datas['url_name'] = str_replace(' ', '-', strtolower($request->name));
        $datas['url'] = url('/').'/academies/'.$datas['url_name'];

        if ($request->hasFile('image')) {
            $upload = upload('/screen/medias/', $request->file('image'), '1');

            $datas['image_path'] = $upload;
            $datas['image_url'] = upload_dir().$upload;
        }

        $academy = Academy::findOrFail($id);
        $academy->update($datas);
        $academy->tags()->sync($datas['tags']);

        if (!$academy->save()) {
            return response()->json(['message' => 'Update academy failed']);
        }

        return response()->json(['message' => "Academy {$academy->name} updated!"]);
    }
    
    public function destroy(Request $request, $id) {
        $academy= Academy::findOrFail($id);

        if ($request->hard) {
            if (filter_var($request->hard, FILTER_VALIDATE_BOOLEAN)) {
                @unlink(base_upload_dir().$academy->image_path);
                
                $academy->tags()->detach();
                $academy->forceDelete();

                return response()->json(['message' => "Academy {$academy->name} permanently deleted!"]);
            }
        }

        $academy->delete();
        
        if (!$academy->save()) {
            return response()->json(['message' => 'Delete academy failed'], 500);
        }
        
        return response()->json(['message' => "Academy {$academy->name} deleted!"]);
    }
}
