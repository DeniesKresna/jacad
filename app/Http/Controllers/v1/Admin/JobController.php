<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Models\Job;
use App\Models\Company;

class JobController extends ApiController {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $page = $request->page;
        $page_size = $request->page_size;
        $search = $request->search;
        $datas = Job::where('id', '>', 0);
        
        if ($request->has('search')) {
            $datas = $datas
                ->where('position', 'like', "%".$search."%")
                ->orWhereHas('company', function($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            });
        }
        
        $datas = $datas->with('company')->orderBy('id', 'desc')->paginate($page_size);

        return response()->json($datas);
    }
    
    public function show($id) {
        $job= Job::with(['company', 'sectors', 'location'])->findOrFail($id);

        return response()->json($job);
    }

    public function update(Request $request, $id) {
        $datas = $request->all();
        $datas['company']= json_decode($request->company, true);
        $datas['job']= json_decode($request->job, true);

        $job = Job::findOrFail($id);

        if ($request->has('verify') && $request->verify) {
            $datas['job']['verificator_id'] = 1;
            $status= 'ditolak';

            if ($request->verify == 'yes') {
                $datas['verified'] = 1;
                $status= 'diterima';
            } else {
                $datas['verified'] = 2;
            }

            $job->verified= $datas['verified'];
            $job->save();   
            
            if ($job) {
                return response()->json(['message' => 'Lowongan '.$status]);
            } else {
                return response()->json(['message' => 'Terjadi kendala, silahkan hubungi teknisi'], 400);
            }

            return response()->json($job);
        }

        $validator = Validator::make(array_merge($datas['company'], $datas['job']), rules_lists(__CLASS__, __FUNCTION__), [
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
            return response()->json(['message' => $validator->messages()], 422);
        }

        if ($request->hasFile('company_logo')) {
            $upload = upload('/screen/medias/logos/', $request->file('company_logo'), '1');
        
            $datas['company']['logo_path'] = $upload;
            $datas['company']['logo_url'] = upload_dir().$upload;
        }

        $company= Company::findOrFail($datas['company']['id']);
        $company->update($datas['company']);
        $company->save();

        $job->update($datas['job']);
        $job->sectors()->sync($datas['job']['sectors']);
        $job->location()->associate($datas['job']['location']);
        $job->save();

        if ($job && $company) {
            return response()->json(['message' => 'Berhasil menyimpan perubahan!']);
        } else {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi teknisi'], 400);
        }
    }

    public function destroy(Request $request, $id){
        $job = Job::findOrFail($id);
        $job->sectors()->detach();
        $job->delete();
        
        return response()->json(['message' => 'Berhasil terhapus!']);
    }
}
