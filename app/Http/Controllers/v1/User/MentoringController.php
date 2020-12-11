<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Models\Mentoring;
use App\Models\MentoringType;

class MentoringController extends ApiController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $datas= $request->all();    
        $datas['mentoring_types']= json_decode($request->mentoring_types);
        $datas['customer_id']= auth()->user()->id;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__), [
            'name.required' => 'Kolom nama harus diisi',
            'email.required' => 'Kolom email harus diisi',
            'phone.required' => 'Kolom nomor handphone harus diisi',
            'domicile.required' => 'Kolom domisili tempat tinggal harus diisi',
            'description.required' => 'Kolom profresi harus diisi',
            'spesific_topic.required' => 'Kolom spesifik topik harus diisi',
            'mentoring_types.required' => 'Kolom jenis topik pembahasan harus diisi',
            'date.required' => 'Kolom tanggal mentoring harus diisi',
            'time.required' => 'Kolom waktu mentoring harus diisi',
            'duration.required' => 'Kolom durasi mentoring harus diisi',
            'jobhun_info' => 'Kolom info jobhun harus diisi'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['fields' => $validator->messages()], 422);
        }

        $datas['mentoring_types']=  array_map(function($type) {
            return new MentoringType(['name' => $type]);
        }, json_decode($request->mentoring_types));

        $mentoring= Mentoring::create($datas);
        $mentoring->mentoring_types()->saveMany($datas['mentoring_types']);
        $mentoring->customer()->update($datas);
        $mentoring->customer->profile()->update([
            'description' => $datas['description'],
            'domicile' => $datas['domicile'],
        ]);
        $mentoring->save();
        
        if ($mentoring) {
            return response()->json(['message' => 'Berhasil daftar!']);
        } else {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi Customer Service'], 400);
        }
    }
}
