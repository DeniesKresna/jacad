<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\AcademyRegistrant;

use Validator;

class AcademyRegistrantController extends Controller
{
    public function store(Request $request) {
        $datas= $request->all();
        $datas['creator_id']= 1;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));

        if ($validator->fails()) {
            return response()->json([
                'fail' => false, 
                'message' => $validator->messages(),
            ], 422);
        }

        $academy_registrant= AcademyRegistrant::create($datas);
        
        if ($academy_registrant) {
            return response()->json(['message' => 'registration created']);
        } else {
            return response()->json(['message' => 'cant create registration'], 400);
        }
    }
}
