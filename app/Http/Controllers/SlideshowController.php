<?php

namespace App\Http\Controllers;

use App\Slideshow;
use Illuminate\Http\Request;

class SlideshowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemslideshow = Slideshow::paginate(10);
        $data = array('title' => 'Dashboard Slideshow',
                    'itemslideshow' => $itemslideshow);
        return view('admin.slideshow.index', $data)->with('no', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        $this->validate($request, [
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $file = $request->file('image');
        // nama file
        $nama_file = time() . "." . $file->getClientOriginalExtension();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'assets/images/';
        // upload file
        $file->move($tujuan_upload, $nama_file);

        $itemuser = $request->user();
        // masukkan data yang dikirim ke dalam variable $inputan
        $inputan = $request->all();
        $inputan['user_id'] = $itemuser->id;
        $inputan['foto'] = $nama_file;
        $itemslideshow = Slideshow::create($inputan);
        return back()->with('success', 'Foto berhasil diupload');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemslideshow = Slideshow::findOrFail($id);
        // cek kalo foto bukan null
        if ($itemslideshow->foto != null) {
            \Storage::delete($itemslideshow->foto);
        }
        if ($itemslideshow->delete()) {
            return back()->with('success', 'Data berhasil dihapus');
        } else {
            return back()->with('error', 'Data gagal dihapus');
        }
    }
}