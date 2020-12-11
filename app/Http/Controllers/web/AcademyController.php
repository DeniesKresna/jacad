<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Academy;

class AcademyController extends Controller
{
    public function index(Request $request) {
        $page_size = $request->page ? $request->page_size : 10;
        $academies= Academy::whereHas('periods', function($query) {
            $query->where('active', 1);
        })->orderBy('academies.id', 'desc')
        ->paginate($page_size);

        return view('pages.academy.list', [
            'title' => 'Jobhun Academy',
            'academies' => $academies
        ]);
    }
    
    public function show($url_name) {
        $academy= Academy::where('url_name', $url_name)->with('tags')->first();

        return view('pages.academy.show', [
            'title' => $academy->name,
            'academy' => $academy
        ]);
    }
}
