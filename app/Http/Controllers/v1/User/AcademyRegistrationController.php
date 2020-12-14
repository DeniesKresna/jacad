<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Models\AcademyPeriod;
use App\Models\AcademyPeriodCustomer;
use App\Models\Payment;
use App\Models\User;
use App\Models\Profile;

use Ixudra\Curl\Facades\Curl;

class AcademyRegistrationController extends ApiController
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

        //UPDATE USER & PROFILE
        $user= User::findOrFail(auth()->user()->id);
        $user->update($datas);
        $user->save();

        $profile= Profile::updateOrCreate(['user_id' => $user->id], $datas);
        $profile->save();

        if (!$user || !$profile) {
            return response()->json(['message' => 'Terjadi kendala saat mengisi data diri, silahkan hubungi Customer Service'], 400);
        }

        //CHECK ACADEMY PERIOD ACTIVE
        $not_active_academies= '';

        foreach ($datas['academies'] as $key => $academy_id) {
            $period= AcademyPeriod::where([
                'period' => $datas['period'],
                'academy_id' => $academy_id
            ])->first();
            
            if ($period->active == 0) {
                if ($key != 0) {
                    $not_active_academies.= ", {$period->academy_class->name}";
                } else {
                    $not_active_academies.= $period->academy_class->name;
                }
            }
        }

        if ($not_active_academies != '') {
            return response()->json(['message' => "Akademi {$not_active_academies} tidak terbuka untuk periode ini"], 404);
        }
        
        //CHECK CUSTOMER ALREADY REGISTERED  
        $registered_academies= '';
        $academy_period_customers= AcademyPeriodCustomer::where('customer_id', $user->id)->get();

        foreach ($academy_period_customers as $key => $period_customer) {
            if (in_array($period_customer->academy_period->academy_class->id, $datas['academies'])) {
                if ($key != 0) {
                    $registered_academies.= ", {$period_customer->academy_period->academy_class->name}";
                } else {
                    $registered_academies.= $period_customer->academy_period->academy_class->name;
                }
            }
        }

        if ($registered_academies != '') {
            return response()->json(['message' => "Anda sudah terdaftar pada akademi {$registered_academies}"], 404);
        }

        //CREATE PERIOD CUSTOMER
        $amount= 0;
        $academy_period_customer= null;
        $academy_period_customer_ids= [];

        foreach ($datas['academies'] as $key => $academy_id) {
            $academy_period= AcademyPeriod::where(['period' => $datas['period'], 'academy_id' => $academy_id])->first();
            $academy_period_customer= AcademyPeriodCustomer::create([
                'price' => $academy_period->price,
                'academy_period_id' => $academy_period->id,
                'customer_id' => $user->id
            ]);
            $amount+= $academy_period->price;
            $academy_period_customer_ids[]= $academy_period_customer->id;    
        }
        
        if (!$academy_period_customer) {
            return response()->json(['message' => 'Terjadi kendala saat mendaftar, silahkan hubungi Customer Service']);
        }

        //PAYMENT
        //$last_period_customer_id= $academy_period->period_customers()->orderBy('pivot_id', 'desc')->first()->pivot->id;
        $last_payment_id= Payment::orderBy('id', 'desc')->value('id')+1;
        $code= 'ORD-JOBHUNACADEMY-V2-'.$academy_period_customer->id.'-'.$last_payment_id;
        
        $payment= Payment::create([
            'amount' => $amount,
            'code' => md5(env('MIDTRANS_MD5_ADDITIONAL_CODE').$code),
            'via' => 'midtrans'
        ]);
        $payment->save();
        
        //UPDATE ACADEMY PERIOD CUSTOMER
        $update_payment_id= AcademyPeriodCustomer::whereIn('id', $academy_period_customer_ids)
            ->update(['payment_id' => $payment->id]);
            
        if (!$payment || !$update_payment_id) {
            return response()->json(['message' => 'Terjadi kendala saat pembayaran, silahkan hubungi Customer Service'], 400);
        }

        //MIDTRANS SNAP
        $snap_response= $this->getMidtransToken($code, $amount);

        if ($snap_response['status']) {
            return response()->json($snap_response['data']);
        } else {
            return response()->json(['message' => $snap_response["message"]], 400);
        }
    }

    private function getMidtransToken($code, $amount) {
        $server_auth_key = 'Basic '.base64_encode(env('MIDTRANS_SERVER_KEY').':');

        if ($server_auth_key) {
            $response = Curl::to('https://app.sandbox.midtrans.com/snap/v1/transactions')
            ->withHeader('Accept: application/json')
            ->withContentType('application/json')
            ->withAuthorization($server_auth_key)
            ->withData([
                'transaction_details' => [
                    'order_id' => $code,
                    'gross_amount' => $amount 
                ],
                'callbacks' => ['finish' => url('/academies/registration')],
            ])->asJson(true)
            ->post();
            
            if (isset($response['token'])) {
                return ['status' => true, 'data' => $response];
            } else {
                return ['status' => false, 'message' => $response['error_messages'][0]];
            }
        } else {
            return ['status' => false, 'message' => 'Terjadi kendala pada server pembayaran, silahkan hubungi Customer Service'];
        }
    }
    
    //MIDTRANS
    public function successPayment(Request $request) {
        if ($request->has('transaction_status')) {
            $transaction_status= $request->transaction_status;
            $payment= Payment::where('code', $request->order_id)->first();
            //$message= '';

            if (!$payment) {
                return response()->json(['message' => 'Data pembayaran tidak ditemukan'], 404);
            }

            if (in_array($transaction_status, ['capture', 'settlement'])) {
                $academy_period_customer_status= 1;
                //$message= 'Pembayaran berhasil. Terima kasih sudah mendaftar!';
            } else if ($transaction_status == 'pending') {
                $academy_period_customer_status= 2;
                //$message= 'Pembayaran pending, tunggu kabar dari admin. Terima kasih sudah mendaftar!';
            } else {
                $academy_period_customer_status= 3;
                //$message= 'Pembayaran gagal, harap coba kembali';
            }

            $update_status= AcademyPeriodCustomer::where('payment_id', $payment->id)
                ->update(['status' => $academy_period_customer_status]);
            
            if (!$update_status) {
                return response()->json(['message' => 'Update pembayaran gagal, silahkan hubungi teknisi'], 404);
            }
            
            $payment->transaction_status= $transaction_status;
            $payment->transaction_id= $request->transaction_id;
            $payment->save();

            return response()->json(['status_code' => 200]);
        } else {
            return response()->json(['status_code' => 400]);
        }
    }
}
