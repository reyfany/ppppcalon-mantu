<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\review;
use App\Kategori;
use App\Slideshow;

class HomepageController extends Controller
{
    public function home(Request $request) {
            $itemproduk = Produk::orderBy('nama_produk', 'desc')->where('status', 'active')->limit(10)->paginate(2);
            $itemkategori = Kategori::orderBy('nama_kategori', 'asc')->limit(6)->get();
            $itemslide = Slideshow::get();
            $data = array(
                'itemproduk' => $itemproduk,
                'itemkategori' => $itemkategori,
                'itemslide' => $itemslide,
            );
            return view('frontend.index', $data)->with('no', ($request->input('page') - 1) * 2);
        }

    // public function produk(Request $request) {
    //     $itemproduk = Produk::orderBy('nama_produk', 'desc')
    //                         ->where('status', 'active')
    //                         ->paginate(5);
    //     $itemkategori = Kategori::orderBy('nama_kategori', 'asc')
    //                             ->where('status', 'active')
    //                             ->get();
    //     $data = array('title' => 'Produk',
    //                 'itemproduk' => $itemproduk,
    //                 'itemkategori' => $itemkategori);
    //     return view('frontend.index', $data)->with('no', ($request->input('page') - 1) * 5);
    // }

    public function produkdetail($id) {
        $itemkategori = Kategori::where('nama_kategori','desc');
        $itemproduk = Produk::where('id', $id)
                            ->where('status', 'active')
                            ->get();
        $data = array('title' => 'Produk',
                    'itemproduk' => $itemproduk,
                    'itemkategori' => $itemkategori
                );
        return view('frontend.pages.produk-detail', $data);            
    }
}