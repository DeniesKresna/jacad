<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\Job;

class JobApplicationController extends ApiController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $job_application= Job::where('id', $request->id)->whereHas('applicants', function($query) {
            $query->where('users.id', auth()->user()->id);
        })->first();
        
        if ($job_application) {
            return response()->json(['message' => 'Lowongan ini sudah/sedang diajukan'], 403);
        }

        $job_application= Job::findOrFail($request->id);
        $job_application->applicants()->attach(auth()->user()->id);
        $job_application->save();

        if ($job_application) {
            return response()->json(['message' => 'Terima kasih sudah melamar >.<']);
        } else {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi Customer Service'], 400);
        }
    }
}
