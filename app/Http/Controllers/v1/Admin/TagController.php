<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Models\Blog;
use App\Models\Tag;

class TagController extends ApiController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $page = $request->page;
        $page_size = $request->page_size;
        $search = $request->search;
        $tags = Tag::where('id','>',0);
        
        if ($request->has('search')) {
            $tags = $tags->where('name', 'like', "%".$search."%");
        }

        $tags = $tags->with(['creator' => function($query) use ($search){
            $query->orWhere('name', 'like', "%".$search."%");
        }]);

        $tags = $tags->orderBy('id', 'DESC')->paginate($page_size);
        
        return response()->json($tags);
    }

    public function list() {
        $tags= Tag::orderBy('name')->get();

        return response()->json($tags);
    }

    public function store(Request $request) {
        $datas = $request->all();
        $datas['creator_id'] = 1;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }
        
        $tag = Tag::create($datas);

        if (!$tag->save()) {
            return response()->json(['message' => 'Create tag failed'], 500);
        }

        return response()->json(['message' => "Tag {$tag->name} created!"]);
    }
    
    public function destroy($id) {
        $tag= Tag::findOrFail($id);
        $blogs= Blog::all();

        foreach ($blogs as $key => $blog) {
            $blog->tags()->detach($tag->id);
        }

        $tag->delete();

        return response()->json(['message' =>  "Tag {$tag->name} deleted!"]);
    }
}

