<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Job;

class JobApplicationController extends Controller
{
    public function store(Request $request) {
        $job_application= Job::where('id', $request->id)->whereHas('applicants', function($query) {
            $query->where('users.id', 3);
        })->first();

        if ($job_application) {
            return response()->json('Lowongan ini sudah/sedang diajukan', 403);
        }

        Job::findOrFail($request->id)->applicants()->attach(3);

        return response()->json('Terima kasih sudah melamar >.<');
    }
}
