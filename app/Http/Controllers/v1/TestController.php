<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Validator;

class TestController extends ApiController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function adi(Request $request)
    {
        $data = $request->all();
        return response()->json($data);
    }
}

