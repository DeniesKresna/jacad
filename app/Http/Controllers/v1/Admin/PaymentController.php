<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Models\Payment;

class PaymentController extends ApiController 
{
    public function index(Request $request) {
        
    }

    public function show(Request $request, $id) {
        $payment= null;

        if ($request->data_payment == 'Academy') {
            $payment= Payment::with(
                'periodCustomers', 
                'periodCustomers.academyPeriod', 
                'periodCustomers.academyPeriod.academy',
                'periodCustomers.customer'
            );
        }
        
        $payment= $payment->findOrFail($id);

        return response()->json($payment);
    }

    public function update(Request $request, $id) {
        $datas= $request->all();

        $validator= Validator::make($datas, rules_lists(__FUNCTION__, __CLASS__));

        if ($validator->fails()) {
            return response()->json(['message' => $validator->message()], 422);
        }

        $payment= Payment::findOrFail($id);
        $payment->update($datas);

        if (!$payment->save()) {
            return response()->json(['message' => 'Update payment failed'], 500);
        }

        return response()->json(['message' => 'Payment updated!']);
    }
}
