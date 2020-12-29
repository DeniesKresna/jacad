<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

use App\Http\Controllers\ApiController;
use App\Notifications\StudentAmbassador as NotifyJSA;
use App\Models\StudentAmbassador;

class StudentAmbassadorController extends ApiController {
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $datas= $request->all();
        $datas['status']= 0;
        
        $validator= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Kamu belum melengkapi formulir pendaftaran ini :( Silakan mengisi formulir pendaftaran ini dengan lengkap ya :)',
                'validation_errors' => $validator->messages()
            ], 422);
        }

        $jsa= StudentAmbassador::create($datas);

        if (!$jsa->save()) {
            return response()->json(['message' => 'Terjadi kendala, silahkan menghubungi Customer Service.'], 500);
        }

        $response= null;

        try {
            Notification::route('mail', $jsa->email)
                        ->notify(new NotifyJSA($jsa->name));
            
            $response= response()->json(['message' => 'Pendaftaran berhasil!']);
        } catch (\Throwable $th) {
            $response= response()->json(['message' => 'Pendaftaran berhasil, tetapi email yang anda catumkukan tidak valid.'], 401);
        }

        return $response;
    }
}
