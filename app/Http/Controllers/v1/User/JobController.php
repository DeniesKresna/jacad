<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

use App\Http\Controllers\ApiController;
use App\Notifications\Job as NotifyJob;
use App\Models\Company;
use App\Models\Job;

class JobController extends ApiController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /*public function index(Request $request) {
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
    }*/

    /*public function show($id) {
        return response()->json(
            Post::findOrFail($id)->load(['categories'])
        );
    }*/
    
    public function store(Request $request) {
        $datas = $request->all();
        $datas['sectors']= json_decode($request->sectors);

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__), [
            'name.required' => 'Kolom nama perusahaan harus diisi',
            'tagline.required' => 'Kolom tagline perusahaan harus diisi',
            'information.required' => 'Kolom informasi perusahaan harus diisi',
            'address.required' => 'Kolom alamat perusahaan harus diisi',
            'phone.required' => 'Kolom nomor telepon perusahaan harus diisi',
            'site_url.required' => 'Kolom website perusahaan harus diisi',
            'email.required' => 'Kolom email perusahaan harus diisi',
            'position.required' => 'Kolom posisi pekerjaan harus diisi',
            'type.required' => 'Kolom jenis pekerjaan harus diisi',
            'sectors.required' => 'Kolom sektor pekerjaan harus diisi',
            'location.required' => 'Kolom lokasi pekerjaan harus diisi',
            'job_desc.required' => 'Kolom deskripsi pekerjaan harus diisi',
            'work_time.required' => 'Kolom waktu bekerja harus diisi',
            'dress_style.required' => 'Kolom gaya berpakaian harus diisi',
            'language.required' => 'Kolom bahasa yang digunakan harus diisi',
            'facility.required' => 'Kolom tunjangan fasilitas harus diisi',
            'salary.required' => 'Kolom besar gaji harus diisi',
            'how_to_send.required' => 'Kolom cara mengirim harus diisi',
            'expired.required' => 'Kolom batas waktu melamar harus diisi',
            'process_time.required' => 'Kolom proses rekrut harus diisi',
            'jobhun_info.required' => 'Kolom info jobhun harus diisi'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['fields' => $validator->messages()], 422);
        }
        
        if ($request->hasFile('logo')) {
            $upload = upload('/screen/medias/logos/', $request->file('logo'), '1');
        
            $datas['logo_path'] = $upload;
            $datas['logo_url'] = upload_dir().$upload;
        }

        $company = Company::updateOrCreate(['name' => trim($datas['name'])], $datas);
        
        $job = Job::create($datas);
        $job->sectors()->attach($datas['sectors']);
        $job->location()->associate($datas['location']);
        $job->save();

        if ($company && $job) {
            $response= null;
            
            try {
                Notification::route('mail', $company->email)->notify(new NotifyJob());

                $response= response()->json(['message' => 'Berhasil menyimpan!']);
            } catch (\Throwable $th) {
                $response= response()->json(['message' => 'Terjadi kendala, silahkan menghubungi Customer Service'], 400);
            }

            return $response;
        }
    }

    /*public function update(Request $request, $id) {
        $datas = $request->all();
        //$session_id = $request->get('auth')->user->id;
        //$datas["customer_id"] = $session_id;
        $datas["creator_id"] = Session::get('user')->id;

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
            'data' => $post,
            'message' => 'post deleted'
        ]);
    }*/
}

