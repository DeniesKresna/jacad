<?php

namespace App\Http\Controllers\v1\User;

use App\Http\Controllers\ApiController;
use App\Models\Job;
use App\Models\Company;
use Illuminate\Http\Request;
use Validator;

class CompanyController extends ApiController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByName($name){
        $company = Company::where('name','like','%'.trim($name).'%')->firstOrFail();
        return response()->json(['company'=>$company]);
    }
}

