<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\Sector;

class SectorController extends ApiController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list() {
        return response()->json(Sector::orderBy('name')->get());
    }
}
