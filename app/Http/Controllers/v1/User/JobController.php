<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

use App\Http\Controllers\ApiController;
use App\Notifications\Job as NotifyJob;
use App\Models\Company;
use App\Models\Job;

class JobController extends ApiController 
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */    
    public function store(Request $request) {
        $datas = $request->all();
        $datas['sectors']= json_decode($request->sectors);
        
        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Kamu belum melengkapi formulir pendaftaran ini :( Silakan mengisi formulir pendaftaran ini dengan lengkap ya :)',
                'validation_errors' => $validator->messages()
            ], 422);
        }
        
        if ($request->hasFile('logo') && $request->file('logo')) {
            $upload = upload('/screen/medias/logos/', $request->file('logo'), '1');
        
            $datas['logo_path'] = $upload;
            $datas['logo_url'] = upload_dir().$upload;
        }

        $company = Company::updateOrCreate(['name' => trim($datas['name'])], $datas);
        
        if (!$company->save()) {
            return response()->json(['message' => 'Terjadi kendala, silahkan menghbungi Customer Service.'], 500);
        }

        $job = Job::create($datas);
        $job->sectors()->attach($datas['sectors']);
        $job->location()->associate($datas['location']);
        
        if (!$job->save()) {
            return response()->json(['message' => 'Terjadi kendala, silahkan menghbungi Customer Service.'], 500);
        }
        
        $response= null;
        
        try {
            Notification::route('mail', $company->email)->notify(new NotifyJob());

            $response= response()->json(['message' => 'Berhasil tersimpan!']);
        } catch (\Throwable $th) {
            $response= response()->json(['message' => 'Berhasil tersimpan, maaf sementara email masih belum bisa :('], 401);
        }

        return $response;
    }
}

