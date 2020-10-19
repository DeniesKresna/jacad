<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\Category;

class CategoryController extends ApiController
{
    public function list() {
        return response()->json(Category::orderBy('name')->get());
    }
}
