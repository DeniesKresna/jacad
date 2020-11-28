<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\Mentor;

use Validator;

class MentorController extends ApiController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $page = $request->page;
        $page_size = $request->page_size;
        $search= $request->search;
        $mentors= Mentor::when($request->has('search') && $request->search, function ($query) use ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        })->orderBy('id', 'desc')
        ->paginate($page_size);

        return response()->json($mentors);
    }

    public function list() {
        return response()->json(Mentor::orderBy('name')->get());
    }

    public function show($id) {
        $mentor= Mentor::findOrFail($id);

        return response()->json($mentor);
    }

    public function store(Request $request) {
        $datas= $request->all();
        $datas['creator_id']= 1;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }
        
        $datas['url_name'] = str_replace(" ", "-", strtolower($datas['name']));
        $datas['url'] = url("/")."/mentors/".$datas['url_name'];

        $upload = upload("/screen/medias/", $request->file('file'), '1');
        
        $datas['image_path'] = $upload;
        $datas['image_url'] = upload_dir().$upload;

        $mentor= Mentor::create($datas);
        $mentor->save();

        if ($mentor) {
            return response()->json(['message' => 'mentor created']);
        } else {
            return response()->json(['message' => 'cant create mentor'], 400);
        }
    }

    public function update(Request $request, $id) {
        $datas= $request->all();
        $datas['updater_id']= 1;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        $datas['url_name'] = str_replace(" ", "-", strtolower($datas['name']));
        $datas['url'] = url("/")."/mentors/".$datas['url_name'];

        if ($request->hasFile('file')) {
            $upload = upload("/screen/medias/", $request->file('file'), '1');
            
            $datas['image_path'] = $upload;
            $datas['image_url'] = upload_dir().$upload;
        }

        $mentor= Mentor::findOrFail($id);
        $mentor->update($datas);
        $mentor->save();

        if ($mentor) {
            return response()->json(['message' => 'mentor updated']);
        } else {
            return response()->json(['message' => 'cant update mentor'], 400);
        }
    }

    public function destroy(Request $request, $id) {
        $mentor= Mentor::findOrFail($id);

        if ($request->has('hard')) {
            if (filter_var(request()->hard, FILTER_VALIDATE_BOOLEAN)) {
                @unlink(base_upload_dir().$mentor->image_path);
                
                $mentor->forceDelete();
                
                return response()->json(['message' => 'mentor deleted']);
            }
        }

        $mentor->delete();
        $mentor->save();

        return response()->json(['message' => 'mentor deleted']);
    }
}
