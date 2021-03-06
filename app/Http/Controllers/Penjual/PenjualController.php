<?php

namespace App\Http\Controllers\Penjual;

use App\Http\Controllers\Controller;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;
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

     public function profile()
     {
        $profile=Auth()->user();
        // return $profile;
        return view('penjual.profile.profile', compact('profile'));
    }

    public function update(Request $request,$id){
        // return $request->all();
        $user=User::findOrFail($id);
        $file = $request->file('photo');
        // nama file
        $nama_file = time() . "." . $file->getClientOriginalExtension();
        $user->photo = $nama_file;
        $tujuan_upload = 'assets/images/';
        // upload file
        $file->move($tujuan_upload, $nama_file);
        $user->save();
        // $user->update($request->all());
        Alert::success('Success', 'Data user berhasil diperbarui');
        return redirect()->back();
    }
}
