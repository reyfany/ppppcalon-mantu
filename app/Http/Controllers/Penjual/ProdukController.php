<?php

namespace App\Http\Controllers\Penjual;

use App\Produk;
use App\Http\Controllers\ImageController;
use RealRashid\SweetAlert\Facades\Alert;
use App\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        // $itemproduk = Produk::orderBy('created_at')->paginate(10);
        $itemuser = $request->user();
        $itemproduk = Produk::where('user_id', $itemuser->id)
        ->where('status', 'active')
        ->orderBy('created_at')
        ->paginate(5);
        return view('penjual.produk.index',compact('itemproduk'))->with('no', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itemkategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('penjual.produk.tambah', compact('itemkategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'slug_produk' => 'required',
            'asal_produk' => 'required',
            'qty' => 'required|numeric',
            'harga' => 'required|numeric',
            'deskripsi'=>'required',
            'kategori_id' => 'required',
            'image'=>'required',
            // 'ongkir'=>'required',
            'status'=>'required|in:active,inactive',
        ]);

        $file = $request->file('image');
        // nama file
        $nama_file = time() . "." . $file->getClientOriginalExtension();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'assets/images/';
        // upload file
        $file->move($tujuan_upload, $nama_file);

        $itemuser = $request->user();//ambil data user yang login
        $slug = \Str::slug($request->slug_produk);//buat slug dari input slug produk
        $inputan = $request->all();
        $inputan['slug_produk'] = $slug;
        $inputan['user_id'] = $itemuser->id;
        $inputan['status'] = $request->status;
        $inputan['image'] = $nama_file;
        $itemproduk = Produk::create($inputan);
        Alert::success('Success', 'Data produk berhasil disimpan');
        return redirect()->route('produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $itemproduk = Produk::findOrFail($id);
        $data = array('title' => 'Foto Produk',
                'itemproduk' => $itemproduk);
        return view('penjual.produk.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemproduk = Produk::findOrFail($id); 
        $itemkategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('penjual.produk.ubah', compact('itemproduk','itemkategori'));
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
        $this->validate($request,[
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'slug_produk' => 'required',
            'asal_produk' => 'required',
            'qty' => 'required|numeric',
            'harga' => 'required|numeric',
            'deskripsi'=>'required',
            // 'ongkir'=>'required',
            'kategori_id' => 'required',
            'image' => 'required|image|file|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'status'=>'required|in:active,inactive',
        ]);
        $itemproduk = Produk::findOrFail($id);
        $file = $request->file('image');
        // nama file
        $nama_file = time() . "." . $file->getClientOriginalExtension();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'assets/images/';
        // upload file
        $file->move($tujuan_upload, $nama_file);

        // kalo ga ada error page not found 404
        $slug = \Str::slug($request->slug_produk);//slug kita gunakan nanti pas buka produk
        // kita validasi dulu, biar tidak ada slug yang sama
        $validasislug = Produk::where('id', '!=', $id)//yang id-nya tidak sama dengan $id
                                ->where('slug_produk', $slug)
                                ->first();
        if ($validasislug) {
            return back()->with('error', 'Slug sudah ada, coba yang lain');
        } else {
            $inputan = $request->all();
            $inputan['slug'] = $slug;
            $inputan['image'] = $nama_file;
            $itemproduk->update($inputan);
            Alert::success('Success', 'Data produk berhasil diperbarui');
            return redirect()->route('produk');     
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produks = Produk::find($id);
        $produks->delete();
        Alert::success('Success', 'Data produk berhasil dihapus');
        return redirect('penjual/produk');
    }
}
