<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\AcademyPeriod;
use App\Models\Payment;

class AcademyRegistrationController extends Controller
{
    public function store(Request $request) {
        $datas= $request->all();
        
        $validator= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__), [
            'name.required' => 'Kolom nama harus diisi',
            'email.required' => 'Kolom email harus diisi',
            'phone.required' => 'Kolom nomor telepon harus diisi',
            'description.required'  => 'Kolom profesi harus diisi',
            'domicile.required' => 'Kolom domisili harus diisi',
            'jobhun_info.required' => 'Kolom informasi Jobhun harus diisi'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        $user= auth()->user();
        $user->update($datas);
        $user->profile->update([
            'description' => $datas['description'],
            'domicile' => $datas['domicile'],
        ]);
        $user->save();
        
        $academy_period= AcademyPeriod::where([
            'academy_id' => $datas['academy_id'],
            'active' => 1
        ])->first();

        if (!$academy_period) {
            return response()->json(['message' => 'Akademi tidak terbuka untuk periode ini'], 404);
        }

        $academy_period_customer= $academy_period->whereHas('period_customers', function($query) use ($user) {
            $query->where('customer_id', $user->id)
                ->where(function($query) use($user) {
                    $query->where('status', 1)
                        ->orWhere('status', 2);
                });
        })->first();        

        if ($academy_period_customer) {
            return response()->json(['message' => 'Anda sudah atau sedang mendaftar akademi ini'], 409);
        }

        $academy_period->period_customers()->attach($user->id, [
            'price' => $academy_period->price,
            'status' => 0
        ]);
        $academy_period->save();
        
        if ($user && $academy_period) {
            return response()->json(['message' => 'Berhasil daftar!']);
        } else {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi teknisi'], 400);
        }
    }

    private function getMidtransToken($code, $amount) {
        
    }

    public function successPayment(Request $request) {

    }

    public function storePayment(Request $request) {

    }
}
