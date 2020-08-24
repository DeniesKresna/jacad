<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobSector;

use Validator;

class JobController extends ApiController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $page = $request->page;
        $page_size = $request->page_size;
        $search = $request->search;
        $datas = Post::where('id', '>', 0);

        if($request->has('search')){
            $datas = $datas->where('title','like',"%".$search."%")
                           ->orWhere('url','like',"%".$search."%");
        }
        $datas = $datas->with(['author'=>function($query) use ($search){
            $query->orWhere('name','like',"%".$search."%");
        }]);

        $datas = $datas->orderBy("id","desc")->paginate($page_size);

        return response()->json($datas);
    }

    public function show($id){
        return response()->json(
            Post::findOrFail($id)->load(['categories'])
        );
    }
    
    public function store(Request $request) {
        $datas = $request->all();
        //$session_id = $request->get('auth')->user->id;
        //$datas["customer_id"] = $session_id;
        $datas['sector_ids']= explode(',', $datas['sector_ids']);
        $datas["creator_id"] = 1;
        $datas["updater_id"] = 1;   

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json([
                'fail' => false, 
                'message' => $validator->messages(),
            ], 422);
        }
        
        $upload = upload('/screen/medias/logos/', $request->file('logo'), '1');
        
        $datas['image_path'] = $upload;
        $datas['image_url'] = upload_dir().$upload;

        $company = Company::updateOrCreate(['name' => trim($datas['name'])], $datas);
        
        if ($company) {
            $job = Job::create($datas)->load(['company']);
            $job_sector= null;
            
            foreach ($datas['sector_ids'] as $key => $id) {
                $job_sector= JobSector::create([
                    'job_id' => $job->id,
                    'sector_id' => $id
                ]);
            }

            if ($job && $job_sector) {
                return response()->json([
                    'data' => [
                        'job' => $job,
                        'sector_ids' => $datas['sector_ids']
                    ],
                    'message' => 'job created'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'cant create job'
            ], 400);
        }
    }

    public function update(Request $request, $id) {
        $datas = $request->all();
        //$session_id = $request->get('auth')->user->id;
        //$datas["customer_id"] = $session_id;
        $datas["creator_id"] = 1;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if($validator->fails()) 
            return response()->json(['fail'=>false,'message'=>$validator->messages()],422);

        $datas['url_title'] = str_replace(" ", "-", strtolower($request->title));
        $datas['url'] = url("/")."/blog/".$datas['url_title'];

        $post = null;

        if($post) {
            $post->update($datas);
            $post->categories()->sync($request->categories);

            return response()->json([
                'data' => $post,' message' => 'post updated'
            ]);
        }
        else
            return response()->json(["message"=>"cant update post"],400);
    }

    public function destroy(Request $request, $id) {
        $post = Post::findOrFail($id);

        if ($request->has('hard')) {
            if (filter_var(request()->hard, FILTER_VALIDATE_BOOLEAN)) {
                @unlink(base_upload_dir().$post->image_path);
                $post->categories()->detach();
                $post->forceDelete();

                return response()->json([
                    'data' => $post, 'message '=> 'post deleted'
                ]);
            }
        }
        
        $post->delete();

        return response()->json([
            'data' => $post,'message' => 'post deleted'
        ]);
    }
}

