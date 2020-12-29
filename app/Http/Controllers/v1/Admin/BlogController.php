<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Models\Blog;

class BlogController extends ApiController {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $page = $request->page;
        $page_size = $request->page_size;
        $search = $request->search;
        $category= $request->category;
        $menu= $request->menu;

        if (($request->has('category') && !$category) || ($request->has('menu') && !$menu)) {
            return response()->json(['message' => 'Request not found'], 400);
        }

        $blogs = Blog::with('author')
            ->when($request->has('search') && $search, function($query) use ($search) {
                $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhereHas('author', function($query) use ($search) {
                        $query->where('users.name', 'LIKE', '%'.$search.'%');    
                    });
            })
            ->when($request->has('category') && $category, function($query) use ($category) {
                $query->whereHas('category', function($query) use ($category) {
                    $query->where('categories.name', $category);
                });
            })
            ->when($request->has('menu') && $menu, function($query) use ($menu) {
                $query->whereHas('category', function($query) use ($menu) {
                    $query->where('categories.menu', 'Blog');
                });
            })
            ->orderBy('id', 'DESC')
            ->paginate($page_size); 

        return response()->json($blogs);
    }

    public function show($id) {
        $blog= Blog::with(['category', 'tags'])->findOrFail($id);

        return response()->json($blog);
    }   
    
    public function store(Request $request) {
        $datas = $request->all();
        $datas['tags']= json_decode($request->tags);
        $datas['author_id'] = 1;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }
        
        $datas['url_title'] = str_replace(' ', '-', strtolower($request->title));
        $datas['url'] = url('/').'/blogs/'.$datas['url_title'];
        
        $upload = upload('/screen/medias/', $request->file('image'), '1');
        
        $datas['image_path'] = $upload;
        $datas['image_url'] = upload_dir().$upload;
        
        $blog = Blog::create($datas); 
        $blog->tags()->attach($datas['tags']);
        
        if (!$blog->save()) {
            return response()->json(['message' => 'Create blog failed'], 500);
        }   

        return response()->json(['message' => "Blog {$blog->title} created!"]);
    }
    
    public function update(Request $request, $id) {
        $datas = $request->all();
        $datas['tags']= json_decode($request->tags);
        $datas['author_id'] = 1;
        
        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }
        
        $datas['url_title'] = str_replace(' ', '-', strtolower($request->title));
        $datas['url'] = url('/').'/blogs/'.$datas['url_title'];

        if ($request->hasFile('image') && $request->file('image')) {
            $upload = upload('/screen/medias/', $request->file('image'), '1');

            $datas['image_path'] = $upload;
            $datas['image_url'] = upload_dir().$upload;
        }

        $blog = Blog::findOrFail($id);
        $blog->update($datas);
        $blog->tags()->sync($datas['tags']);
        
        if (!$blog->save()) {
            return response()->json(['message' => 'Update blog failed'], 500);
        }   

        return response()->json(['message' => "Blog {$blog->title} updated!"]);
    }
    
    public function destroy(Request $request, $id) {
        $blog = Blog::findOrFail($id);
        
        if ($request->hard) {
            if (filter_var(request()->hard, FILTER_VALIDATE_BOOLEAN)) {
                @unlink(base_upload_dir().$blog->image_path);
                
                $blog->tags()->detach();
                $blog->forceDelete();
                
                return response()->json(['message' => "Blog {$blog->title} permanently deleted!"]);
            }
        }
        
        $blog->delete();
        
        if (!$blog->save()) {
            return response()->json(['message' => 'Delte blog failed'], 500);
        }
        
        return response()->json(['message' => "Blog {$blog->title} deleted!"]);
    }
}

