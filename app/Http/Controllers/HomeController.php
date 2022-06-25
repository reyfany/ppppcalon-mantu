<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
        // if (Auth::user()->role == 'admin') { 
        //     return view('frontend.index');
        // } elseif (Auth::user()->role == 'penjual') { 
        //     return view('frontend.index');
        // } elseif (Auth::user()->role == 'pembeli') { 
        //     return view('frontend.index');
        // }
    }
}
