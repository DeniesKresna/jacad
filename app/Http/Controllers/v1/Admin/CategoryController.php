<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\Category;

class CategoryController extends ApiController
{
    public function list(Request $request) {
        $datas= Category::where('id', '>', 0);
        
        if ($request->has('name')) {
            $datas= $datas->where('name', $request->name);
        }

        if ($request->has('menu')) {
            $datas= $datas->where('menu', $request->menu);
        }

        $datas= $datas->orderBy('name')->get();

        return response()->json($datas);
    }
}
