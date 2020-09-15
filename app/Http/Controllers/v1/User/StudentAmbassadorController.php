<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

use App\Http\Controllers\ApiController;
use App\Notifications\StudentAmbassador as NotifyJSA;
use App\Models\StudentAmbassador;

use Validator;

class StudentAmbassadorController extends ApiController {
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {

    }

    public function store(Request $request) {
        $datas= $request->all();
        $datas['status']= 0;
        
        $validator= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));

        if ($validator->fails()) {
            return response()->json([
                'fail' => false, 
                'message' => $validator->messages(),
            ], 422);
        }

        $jsa= StudentAmbassador::create($datas);
        
        if ($jsa) {
            Notification::route('mail', $datas['email'])
                        ->notify(new NotifyJSA(
                            'Terima kasih telah mendaftar pada Jobhun Student Ambassador.
                            \r\nTunggu informasi lebih lanjut dari kami ya!'
                        ));
            
            return response()->json([
                'data' => [
                    'jsa' => $jsa
                ], 
                'message' => 'jsa created'
            ], 200);
        } else {
            return response()->json([
                'message' => 'cant create jsa'
            ], 400);
        }
    }
}
