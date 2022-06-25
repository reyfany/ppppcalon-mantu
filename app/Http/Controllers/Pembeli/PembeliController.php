<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    //
    public function index()
    {
        $profile=Auth()->user();
        return view('pembeli.dashboard')->with('profile',$profile);
    }
}
