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

    public function registration(Request $request) {
        $period= '';
        $academies= Academy::whereHas('periods', function($query) {
            $query->where('active', 1)->groupBy('period');
        })->orderBy('name')
        ->get();
        
        foreach ($academies as $key => $academy) {
            $period= $academy->periods->first()->period;
        }

        $payment_success= false;

        if (($request->status_code && $request->status_code == 200) && ($request->transaction_status && $request->transaction_status == 'settlement')) {
            $payment_success= true;
        }

        return view('pages.academy.registration',  [
            'title' => 'Pendaftaran Jobhun Academy',
            'period' => $period,
            'academies' => $academies,
            'payment_success' => $payment_success
        ]);
    }
}
