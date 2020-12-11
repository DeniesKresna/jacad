<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Models\Opening;

class OpeningController extends ApiController
{   
    public function show($service) {
        $opening= Opening::where('service', $service)->first();

        return response()->json($opening);
    }

    public function store(Request $request) {
        $datas= $request->all();

        $validator= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__), [
            'content.required' => 'Kolom konten tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        $opening= Opening::where('service', $datas['service'])->first();

        if (!$opening) {
            $datas['creator_id']= 1;
        } else {
            $datas['updater_id']= 1;
        }
        
        $opening= Opening::updateOrCreate(['service' => $datas['service']], $datas);
        $opening->save();

        if ($opening) {
            return response()->json(['message' => 'Berhasil menyimpan Opening!']);
        } else {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi teknisi'], 400);
        }
    }
}
