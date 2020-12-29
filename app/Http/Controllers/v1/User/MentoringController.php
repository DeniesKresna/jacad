<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Models\User;
use App\Models\Profile;
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

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Kamu belum melengkapi formulir pendaftaran ini :( Silakan mengisi formulir pendaftaran ini dengan lengkap ya :)',
                'validation_errors' => $validator->messages()
            ], 422);
        }

        //UPDATE USER & PROFILE
        $user= User::findOrFail(auth()->user()->id);
        $user->update($datas);

        if (!$user->save()) {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi Customer Service.'], 500);
        }

        $profile= Profile::updateOrCreate(['user_id' => $user->id], $datas);

        if (!$profile->save()) {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi Customer Service.'], 500);
        }

        $datas['mentoring_types']= array_map(function($type) {
            return new MentoringType(['name' => $type]);
        }, json_decode($request->mentoring_types));

        $mentoring= Mentoring::create($datas);
        $mentoring->customer()->associate($user->id);
        $mentoring->mentoringTypes()->saveMany($datas['mentoring_types']);
        
        if (!$mentoring->save()) {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi Customer Service.'], 500);
        }

        return response()->json(['message' => 'Pendaftaran berhasil!']);
    }
}
