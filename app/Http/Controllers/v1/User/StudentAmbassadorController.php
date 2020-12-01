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
        
        $validator= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__), [
            'email.required' => 'Kolom email harus diisi',
            'name.required' => 'Kolom nama harus diisi',
            'age.required' => 'Kolom umur harus diisi',
            'address.required' => 'Kolom alamat harus diisi',
            'university.required' => 'Kolom universitas harus diisi',
            'faculty.required' => 'Kolom fakultas harus diisi',
            'major.required' => 'Kolom jurusan harus diisi',
            'phone.required' => 'Kolom nomor handphone harus diisi',
            'line_id.required' => 'Kolom ID Line harus diisi',
            'ig_url.required' => 'Kolom link profil Instagram harus diisi',
            'linkedIn_url.required' => 'Kolom link profil LinkedIn harus diisi'
        ]);

        if ($validator->fails()) {
            return response()->json(['fields' => $validator->messages()], 422);
        }

        $jsa= StudentAmbassador::create($datas);
        
        if ($jsa) {
            Notification::route('mail', $datas['email'])
                        ->notify(new NotifyJSA(
                            'Terima kasih telah mendaftar pada Jobhun Student Ambassador.
                            \r\nTunggu informasi lebih lanjut dari kami ya!'
                        ));
            
            return response()->json(['message' => 'Berhasil daftar!']);
        } else {
            return response()->json(['message' => 'Terjadi kendala, silahkan menghubungi Customer Service'], 400);
        }
    }
}
