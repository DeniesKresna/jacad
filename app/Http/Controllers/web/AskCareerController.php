<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\AskCareer; 

class AskCareerController extends Controller
{
    public function index(Request $request) {
        $page_size = $request->page ? $request->page_size : 10;
        $ask_careers= AskCareer::orderBy('id', 'desc')->paginate($page_size);

        return view('pages.ask-career.list', [
            'title' => 'Jobhun Ask Career',
            'ask_careers' => $ask_careers
        ]);
    }

    public function show($url_name) {
        $ask_career= AskCareer::whereHas('mentor', function($query) use ($url_name) {
            $query->where('url_name', $url_name);
        })->first();
        
        return view('pages.ask-career.show', [
            'title' => $ask_career->name,
            'ask_career' => $ask_career
        ]);
    }
}
