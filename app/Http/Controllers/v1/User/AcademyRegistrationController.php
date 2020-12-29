<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Traits\Promo;
use App\Models\Academy;
use App\Models\AcademyPeriod;
use App\Models\AcademyPeriodCustomer;
use App\Models\Payment;
use App\Models\User;
use App\Models\Profile;

use Ixudra\Curl\Facades\Curl;

class AcademyRegistrationController extends ApiController {
    use Promo;

    public function store(Request $request) {
        $datas= $request->all();

        $validator= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Kamu belum melengkapi formulir pendaftaran ini :( Silakan mengisi formulir pendaftaran ini dengan lengkap ya :)',
                'validation_errors' => $validator->messages()
            ], 422);
        }

        if (!auth()->user()) {
            return response()->json(['message' => 'Sebelum mendaftar, silahkan masuk terlebih dahulu ya!'], 401);
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
        
        //CHECK ACADEMY EXIST
        $academies= Academy::whereIn('id', $datas['academy_ids'])->pluck('id')->toArray();

        if (count($academies) !== count($datas['academy_ids'])) {
            return response()->json(['message' => 'Periksa pemilihan kelas kembali.'], 404);
        }

        //CHECK ACADEMY PERIOD ACTIVE       
        $academy_periods= AcademyPeriod::whereIn('academy_id', $academies)->where('active', 1)->get();

        if (count($academy_periods) !== count($datas['academy_ids'])) {
            return response()->json(['message' => 'Periksa pemilihan kelas kembali.'], 404);
        }

        //CHECK CUSTOMER ALREADY REGISTERED
        $amount= 0;
        $academy_period_customer_ids= [];

        foreach ($academy_periods as $key => $academy_period) {
            $academy_period_customer= AcademyPeriodCustomer::where(['academy_period_id' => $academy_period->id, 'customer_id' => $user->id])
                ->where(function($query) use ($academy_period) {
                    $query->where('status', 1)
                          ->orWhere('status', 2);
                })
                ->first();
            
            if ($academy_period_customer) {
                return response()->json(['message' => "Kamu sudah pernah mendaftar kelas {$academy_period->academy->name}. Pendaftaran dibatalkan"], 409);
                /*if ($academy_period_customer->status === 1 || $academy_period_customer->status === 2) {
                    return response()->json(['message' => "Kamu sudah pernah mendaftar kelas {$academy_period->academy->name}. Pendaftaran dibatalkan"], 409);
                }*/
            }

            $academy_period_customer= AcademyPeriodCustomer::create([
                'price' => $academy_period->price,
                'academy_period_id' => $academy_period->id,
                'customer_id' => $user->id
            ]);
            $amount+= $academy_period->price;
            $academy_period_customer_ids[]= $academy_period_customer->id;
        }

        //CHECK ERROR, JIKA PERIOD CUSTOMER SUDAH TERLANJUR INSERT KE DB DAN STATUS = 0, MAKA HAPUS 
        /*if (count($academy_period_customer_ids) === 0) {
            $unused_data= AcademyPeriodCustomer::orderBy('id', 'desc')->take(count($academy_periods))->delete();

            if ($unused_data !== count($academy_periods)) {
                return response()->json(['message' => 'Terjadi kendala, silahkan hubungi Customer Service'], 500);
            }
        }*/

        //CHECK PROMO CODE
        $promo= $this->getPromo($amount, $request->promo_code, $academy_period_customer_ids);

        if (!$promo['status']) {
            return response()->json(['message' => $promo['message']], 404);
        }

        $amount= $promo['amount'];

        //PAYMENT
        $code= 'ORDER-JOBHUNACADEMY-';

        foreach ($academy_period_customer_ids as $key => $id) {
            $code.= $id.'-';
        }
        
        $code.= date('Y-m-d-H-i-s');

        $payment= Payment::create([
            'amount' => $amount,
            'code' => $code,
            'via' => 'midtrans',
        ]);
        
        if (!$payment->save()) {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi Customer Service.', 500]);
        }

        $academy_period_customers= AcademyPeriodCustomer::whereIn('id', $academy_period_customer_ids)->update(['payment_id' => $payment->id]);

        if (!$academy_period_customers === count($academy_period_customer_ids)) {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi Customer Service.'], 500);
        }

        //MIDTRANS SNAP
        $snap_response= $this->getMidtransToken($code, $amount);

        if ($snap_response['status']) {
            return response()->json($snap_response['data']);
        } else {
            return response()->json(['message' => $snap_response['message']], 400);
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
            return ['status' => false, 'message' => 'Terjadi kendala pada server pembayaran, silahkan hubungi Customer Service.'];
        }
    }
    
    //MIDTRANS
    public function successPayment(Request $request) {
        if (!$request->transaction_status) {
            return response()->json(['message' => 'Midtrans error request'], 400);
        }

        $transaction_status= $request->transaction_status;
        $order_id= $request->order_id;
        $status_code= $request->status_code;
        $gross_amount = $request->gross_amount;
        $server_key = env('MIDTRANS_SERVER_KEY');

        $sha512 = hash('sha512', $order_id.$status_code.$gross_amount.$server_key);

        if ($sha512 != $request->signature_key) {
            return response()->json(['message' => 'Midtrans unauthorized request'], 401);
        }

        $payment = Payment::where('code', $order_id)->firstOrFail();

        if (in_array($transaction_status, ['capture', 'settlement'])) {
            $status= 1;
        } else if ($transaction_status == 'pending') {
            $status= 2;
        } else {
            $status= 3;
        }

        //CHECK PAYMENT SUCCESS
        $academy_period_customers= AcademyPeriodCustomer::where('payment_id', $payment->id)->get();
        $academies= [];

        foreach ($academy_period_customers as $key => $period_customer) {
            if ($period_customer->status === 1) {
                return response()->json(['message' => 'Has been paid'], 409);
            }
            
            $academies[]= [
                'name' => $period_customer->academyPeriod->academy->name,
                'period' => $period_customer->academyPeriod->period
            ];
        }

        $academy_period_customers= AcademyPeriodCustomer::where('payment_id', $payment->id)->update(['status' => $status]);

        if ($academy_period_customers <= 0) {
            return response()->json(['message' => 'Update academy period customer status failed'], 500);
        }

        $payment->transaction_status= $transaction_status;
        $payment->transaction_id= $request->transaction_id;
        
        if (!$payment->save()) {
            return response()->json(['message' => 'Update payment failed'], 500);
        }

        $response= null;

        try {
            $response= response()->json(['message' => 'Payment success']);
        } catch (\Throwable $th) {
            $response= response()->json(['message' => 'Payment success, but send email failed']);
        }
        
        return $response;
    }
}
