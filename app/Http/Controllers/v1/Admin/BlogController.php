<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\ApiController;
use App\Models\Blog;

use Validator;

class BlogController extends ApiController
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
        $datas = Blog::where('id', '>' ,0);
        
        if ($request->has('search') && $request->search) {
            $datas= $datas->where(function($query) use ($search) {
                $query->where('title', 'like', "%".$search."%")
                      ->orWhere('url', 'like', "%".$search."%");
            });
        }

        if ($request->has('category') && $request->category) {
            $category= $request->category;
            $datas= $datas->whereHas('category', function($query) use ($category) {
                $query->where('name', $category);
            });
        }

        if ($request->has('menu') && $request->menu) {
            $menu= $request->menu;
            $datas= $datas->whereHas('category', function($query) use ($menu) {
                $query->where('menu', $menu);
            });
        }

        $datas = $datas->with(['author' => function($query) use ($search) {
            $query->orWhere('name', 'like', "%".$search."%");
        }]);
        $datas = $datas->orderBy('id', 'desc')->paginate($page_size);

        return response()->json($datas);
    }

    public function show($id) {
        return response()->json(
            Blog::findOrFail($id)->load(['category', 'tags'])
        );
    }   
    
    public function store(Request $request) {
        $datas = $request->all();
        $datas['tags']= explode(',', $datas['tags']);
        $datas['author_id'] = Session::get('user') ? Session::get('user')->id : 1;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json([
                'fail' => false, 
                'message' => $validator->messages()
            ], 422);
        }
        
        $datas['url_title'] = str_replace(" ", "-", strtolower($request->title));
        $datas['url'] = url("/")."/blogs/".$datas['url_title'];
        
        $upload = upload("/screen/medias/", $request->file('file'), '1');
        
        $datas['image_path'] = $upload;
        $datas['image_url'] = upload_dir().$upload;
        
        $blog = Blog::create($datas); 
        $blog->category()->associate($datas['category']);
        $blog->tags()->attach($datas['tags']);
        $blog->save();
        
        if ($blog) {
            return response()->json([ 
                'message' => 'blog created'
            ]);
        } else {
            return response()->json([
                "message" => "cant create blog"
            ], 400);
        }
    }
    
    public function update(Request $request, $id) {
        $datas = $request->all();
        $datas['tags']= explode(',', $datas['tags']);
        $datas['author_id'] = 1;
        
        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json([
                'fail' => false,
                'message' => $validator->messages()
            ], 422);
        }

        $datas['url_title'] = str_replace(" ", "-", strtolower($datas['title']));
        $datas['url'] = url("/")."/blogs/".$datas['url_title'];

        if ($request->hasFile('file')) {
            $upload = upload("/screen/medias/", $request->file('file'), '1');
        
            $datas['image_path'] = $upload;
            $datas['image_url'] = upload_dir().$upload;
        }

        $blog = Blog::findOrFail($id);
        $blog->update($datas);
        $blog->category()->associate($datas['category']);
        $blog->tags()->sync($datas['tags']);
        $blog->save();
        
        if ($blog) {
            return response()->json([
                'message' => 'blog updated'
            ]);
        } else {
            return response()->json([
                'message'=> 'cant update blog'
            ], 400);
        }
    }
    
    public function destroy(Request $request, $id) {
        $blog = Blog::findOrFail($id);
        
        if ($request->has('hard')) {
            if (filter_var(request()->hard, FILTER_VALIDATE_BOOLEAN)) {
                @unlink(base_upload_dir().$blog->image_path);
                
                $blog->tags()->detach();
                $blog->forceDelete();
                
                return response()->json([
                    'message' => 'blog deleted'
                ]);
            }
        }
        
        $blog->delete();
        $blog->save();
        
        return response()->json([
            'message' => 'blog deleted'
        ]);
    }
}

