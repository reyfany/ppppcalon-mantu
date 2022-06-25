<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::orderBy('id','ASC')->paginate(10);
        return view('admin.users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'name'=>'string|required|max:30',
            'email'=>'string|required|unique:users',
            'password'=>'required|same:konfirm_password',
            'role'=>'required|in:admin,pembeli,penjual',
            'photo'=>'nullable',
            'phone'=>'nullable|string',
            'alamat'=>'nullable|string',
        ]);

        $file = $request->file('photo');
        // nama file
        $nama_file = time() . "." . $file->getClientOriginalExtension();

        // user baru
        $user=new user();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->role=$request->role;
        $user->photo=$nama_file;
        $user->phone=$request->phone;
        $user->alamat=$request->alamat;
       
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'assets/images/';

        // upload file
        $file->move($tujuan_upload, $nama_file);
        $user->save();
        Alert::success('Success', 'Data user berhasil disimpan');
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user=User::findOrFail($id);
        return view('admin.users.ubah')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) 
    {
        $request->validate([
            'name'=>'string|required|max:30',
            'email'=>'string',
            'password'=>'required|same:konfirm_password',
            'role'=>'required|in:admin,pembeli,penjual',
            'photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'phone'=>'nullable|string',
            'alamat'=>'nullable|string',
        ]);

        $user = User::find($id);
        $file = $request->file('photo');
        // nama file
        $nama_file = time() . "." . $file->getClientOriginalExtension();
        // $file = $request->file('photo');

        // nama file
        // if ($file == "") {
        //     $nama_file = $user->photo;
        // } else {
        //     $user = User::where('id', $id)->first();
        //     File::delete('assets/images/' . $user->photo);
        //     $nama_file = time() . "." . $file->getClientOriginalExtension();
        // }
        $user->name = $request->get('name');
        $user->photo = $nama_file;
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->role = $request->get('role');
        $user->phone = $request->get('phone');
        $user->alamat = $request->get('alamat');

        // upload file
        // $tujuan_upload = 'aassets/images/';
        // if ($file == "") {
        // } else {
        //     $file->move($tujuan_upload, $nama_file);
        // }

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'assets/images/';

        // upload file
        $file->move($tujuan_upload, $nama_file);

        $user->save();
        // $user->update();
        Alert::success('Success', 'Data user berhasil diperbarui');
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findorFail($id);
        $user->delete();
        Alert::success('Success', 'Data user berhasil dihapus');
        return redirect('admin/users');
    }
}