<?php

namespace App\Http\Controllers\Penjual;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Alert;
use Illuminate\Http\Request;

class PenjualController extends Controller
{
    //
     //
     public function index()
     {
        $profile=Auth()->user();
            return view('penjual.dashboard')->with('profile',$profile);
     }

     public function profile(){
        $profile=Auth()->user();
        // return $profile;
        return view('penjual.profile.profile')->with('profile',$profile);
    }

    public function update(Request $request,$id){
        // return $request->all();
        $user=User::findOrFail($id);
        $user->update($request->all());
        Alert::success('Success', 'Data user berhasil diperbarui');
        return redirect()->back();
    }
}
