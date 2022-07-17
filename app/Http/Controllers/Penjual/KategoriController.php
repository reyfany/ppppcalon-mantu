<?php

namespace App\Http\Controllers\Penjual;

use App\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class KategoriController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
        $itemuser = $request->user();
        $itemkategori = Kategori::where('user_id', $itemuser->id)
        ->where('status', 'active')
        ->paginate(5);
        return view('penjual.kategori.index',compact('itemkategori'))
        ->with('no',  ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('penjual.kategori.tambah');
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
            // 'kode_kategori' => 'required',
            'nama_kategori'=>'required|string|max:255',
            'slug_kategori' => 'required',
            'deskripsi'=>'required|string|max:255',
        ]);
        $itemuser = $request->user();//kita panggil data user yang sedang login
        $inputan = $request->all();//kita masukkan semua variabel data yang diinput ke variabel $inputan
        $inputan['user_id'] = $itemuser->id;
        $inputan['slug_kategori'] = \Str::slug($request->slug_kategori);//kita buat slug biar pemisahnya menjadi strip (-)
        //slug kita gunakan nanti pas buka produk per kategori
        $inputan['status'] = 'active';//status kita set langsung active saja
        $itemkategori = Kategori::create($inputan);
        return redirect('penjual/kategori')->with('Success', 'Data kategori berhasil disimpan');
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
        $itemkategori = Kategori::findOrFail($id);//cari berdasarkan id = $id, 
        return view('penjual.kategori.ubah', compact('itemkategori'));
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
        $this->validate($request, [
            'nama_kategori'=>'required',
            'slug_kategori' => 'required',
            'deskripsi' => 'required',
        ]);
        $itemkategori = Kategori::findOrFail($id);//cari berdasarkan id = $id, 
        // kalo ga ada error page not found 404
        $slug = \Str::slug($request->slug_kategori);//slug kita gunakan nanti pas buka produk per kategori
        // kita validasi dulu, biar tidak ada slug yang sama
        $validasislug = Kategori::where('id', '!=', $id)//yang id-nya tidak sama dengan $id
                                ->where('slug_kategori', $slug)
                                ->first();
        if ($validasislug) {
            return back()->with('error', 'Slug sudah ada, coba yang lain');
        } else {
            $inputan = $request->all();
            $inputan['slug'] = $slug;
            $itemkategori->update($inputan);
            return redirect()->route('kategori')->with('Success', 'Data kategori berhasil diubah');
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
        $itemkategori = Kategori::find($id);
        if (count($itemkategori->produk) > 0) {
            // dicek dulu, kalo ada produk di dalam kategori maka proses hapus dihentikan
            return back()->with('error', 'Hapus dulu produk di dalam kategori ini, proses dihentikan');
        } else {
            if ($itemkategori->delete()) {
                return back()->with('Success', 'Data kategori berhasil dihapus');
            } else {
                return back()->with('error', 'Data gagal dihapus');
            }
        }
        return redirect()->route('kategori')->with('Success', 'Data kategori berhasil dihapus');
    }
}