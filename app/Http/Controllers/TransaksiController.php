<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\AlamatPengiriman;
use App\CartDetail;
use App\Order;
use App\confirm;
use Illuminate\Support\Facades\DB;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemuser = $request->user();
        $confirms = confirm::get();
        if ($itemuser->role == 'penjual') 
        {
            // $itemorder = Order::whereHas('cart', function($q) {
            //     $q->where('status_cart', 'checkout');
            //     $q->where('user_id', 'checkout');
            // })
            
            //     ->orderBy('id')
            //     ->paginate(15);

                $itemorder = Order::select('carts.no_invoice as no_invoice', DB::raw('orders.*, orders.id as orderID, carts.status_pembayaran, carts.status_pengiriman') )
                                ->join('carts', 'carts.id', '=', 'orders.cart_id')
                                ->join('cart_details', 'cart_details.cart_id', '=', 'orders.cart_id')
                                ->join('produks', 'produks.id', '=', 'cart_details.produk_id')
                                ->where('produks.user_id', $itemuser->id)
                                ->groupBy('no_invoice')
                                ->paginate(15);
                    // dd($itemorder);
        }
        

        if  ($itemuser->role == 'pembeli') 
        {
            // kalo member maka menampilkan cart punyanya sendiri
            // $itemorder = Order::whereHas('cart', function($q) use ($itemuser) {
            //                 $q->where('status_cart', 'checkout');
            //                 $q->where('user_id', $itemuser->id);
            //             })
            //             ->orderBy('id')
            //             ->paginate(15);
            $itemorder = Order::select('carts.no_invoice as no_invoice', DB::raw('orders.*, orders.id as orderID, carts.status_pembayaran, carts.status_pengiriman') )
                                ->join('carts', 'carts.id', '=', 'orders.cart_id')
                                ->where('carts.user_id', $itemuser->id)
                                ->groupBy('no_invoice')
                                ->paginate(15);
        }
        // dd($confirms);
        $data = array('title' => 'Data Transaksi',
                    'itemorder' => $itemorder,
                    'itemuser' => $itemuser,
                    'confirms' => $confirms
                );
                // dd($data);
                // dd($data);
        return view('transaksi.index', $data);
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
        $itemuser = $request->user();
        $itemcart = Cart::where('status_cart', 'cart')
                        ->where('user_id', $itemuser->id)
                        ->first();
        if ($itemcart) {
            $itemalamatpengiriman = AlamatPengiriman::where('user_id', $itemuser->id)
                                                    // ->where('status', 'utama')
                                                    ->first();
            if ($itemalamatpengiriman) {
                // buat variabel inputan order
                $inputanorder['cart_id'] = $itemcart->id;
                $inputanorder['nama_penerima'] = $itemalamatpengiriman->nama_penerima;
                $inputanorder['no_tlp'] = $itemalamatpengiriman->no_tlp;
                $inputanorder['alamat'] = $itemalamatpengiriman->alamat;
                $inputanorder['provinsi'] = $itemalamatpengiriman->provinsi;
                $inputanorder['kota'] = $itemalamatpengiriman->kota;
                $inputanorder['kecamatan'] = $itemalamatpengiriman->kecamatan;
                $inputanorder['kelurahan'] = $itemalamatpengiriman->kelurahan;
                $inputanorder['kodepos'] = $itemalamatpengiriman->kodepos;
                $itemorder = Order::create($inputanorder);//simpan order
                // update status cart
                $itemcart->update(['status_cart' => 'checkout', 'subtotal' => $request->total, 'total' => $request->total]);
                return redirect()->route('transaksi')->with('success', 'Order berhasil disimpan');
            } else {
                return back()->with('error', 'Alamat pengiriman belum diisi');
            }
        } else {
            return abort('404');//kalo ternyata ga ada shopping cart, maka akan menampilkan error halaman tidak ditemukan
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        $itemuser = $request->user();
        if ($itemuser->role == 'penjual') {
            $itemorder = Order::findOrFail($id);
            $data = array('title' => 'Detail Transaksi',
                        'itemorder' => $itemorder);
            return view('transaksi.show', $data)->with('no', 1);            
        } else {
            $itemorder = Order::where('id', $id)
                            ->whereHas('cart', function($q) use ($itemuser) {
                                $q->where('user_id', $itemuser->id);
                            })->first();
            if ($itemorder) {
                $data = array('title' => 'Detail Transaksi',
                            'itemorder' => $itemorder);
                return view('transaksi.show', $data)->with('no', 1);                            
            } else {
                return abort('404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $itemuser = $request->user();
        // if ($itemuser->role == 'penjual' or $itemuser->role == 'pembeli') {
            if ($itemuser->role == 'penjual') {
            $itemorder = Order::findOrFail($id);
            $data = array('title' => 'Form Edit Transaksi',
                        'itemorder' => $itemorder);
            return view('transaksi.edit', $data)->with('no', 1);            
        } else {
            return abort('404');//kalo bukan penjual maka akan tampil error halaman tidak ditemukan
        }
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
            'status_pembayaran' => 'required',
            'status_pengiriman' => 'required',
            'subtotal' => 'required|numeric',
            'ongkir' => 'required|numeric',
            'total' => 'required|numeric',
           
        ]);
        
        $inputan['status_pembayaran'] = $request->status_pembayaran;
        $inputan['status_pengiriman'] = $request->status_pengiriman;
        $inputan['subtotal'] = str_replace(',','',$request->subtotal);
        $inputan['ongkir'] = str_replace(',','',$request->ongkir);
        $inputan['total'] = str_replace(',','',$request->total);


        $itemorder = Order::findOrFail($id);
        $itemorder->cart->update($inputan);
        return back()->with('success','Order berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //
    }

    public function indexconfirm(Request $request, $id)
    {
        $itemuser = $request->user(); 
        $data = array('title' => 'Data Transaksi',
                    'itemuser' => $itemuser,
                    );
        return view('transaksi.konfirmasi', $data);
    }

    public function storeconfirm(Request $request)
    {
        $itemuser = $request->user();
        $itemcart = Cart::where('user_id', $itemuser->id)->latest()->first();
        // $itemorder = Order::where('cart_id', $id)->first();
        $itemorder = Order::whereHas('cart', function($q) use ($itemuser) {
            $q->where('status_cart', 'checkout');
            $q->where('user_id', $itemuser->id);
        });
        $confirm = new confirm();
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $newName = rand(100000,1001238912).".".$ext;
        $file->move('assets/images/', $newName);

        $confirm->cart_id       = $itemcart->id;
        $confirm->user_id       = $itemuser->id;
        $confirm->order_id      = $itemcart->id;
        $confirm->image         = $newName;
        // dd($confirm);
        $confirm->save();

        return back()->with('success', 'Konfirmasi Bukti Pembayaran Berhasil Dikirm');
    }

}
