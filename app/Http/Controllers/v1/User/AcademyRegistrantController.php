<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\AcademyRegistrant;

class AcademyRegistrantController extends Controller
{
    public function store(Request $request) {
        $datas= $request->all();
        $datas['creator_id']= auth()->user()->id;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__), [
            'name.required' => 'Kolom nama harus diisi',
            'email.required' => 'Kolom email harus diisi',
            'phone.required' => 'Kolom nomor WhatsApp harus diisi',
            'description.required' => 'Kolom profesi harus diisi',
            'domicile.required' => 'Kolom kota harus diisi',
            'jobhun_info.required' => 'Kolom info Jobhun harus diisi'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        $academy_registrant= AcademyRegistrant::create($datas);
        
        if ($academy_registrant) {
            return response()->json(['message' => 'Berhasil registrasi!']);
        } else {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi teknisi'], 400);
        }
    }
}
