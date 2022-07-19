<?php

namespace App\Http\Controllers;

use App\Cart;
use App\AlamatPengiriman;
use App\CartDetail;
use App\Produk;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemuser = $request->user();//ambil data user
        $itemcart = Cart::where('user_id', $itemuser->id)
                        ->where('status_cart', 'cart')
                        ->first();
        if ($itemcart) {
            $data = array('itemcart' => $itemcart);
            return view('frontend.pages.cartdetail', $data)->with('no', 1);            
        } else {
            return abort('403', 'Keranjang pembelian anda masih kosong');
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function kosongkan($id) {
        $itemcart = Cart::findOrFail($id);
        $itemcart->detail()->delete();//hapus semua item di cart detail
        $itemcart->updatetotal($itemcart, '-'.$itemcart->subtotal,$itemcart->no_invoice );
        return back()->with('success', 'Cart berhasil dikosongkan');
    }

    public function checkout(Request $request) {
        
        $total = 0;
        for ($i=0; $i < sizeof($request->id); $i++) { 
            $cartdetail = CartDetail::find($request->id[$i]);
            $cartdetail->qty = $request->jumlah[$i];
            $cartdetail->subtotal = $request->subtotal[$i];
            $cartdetail->update();
            
            $total = $total + $cartdetail->subtotal;
        }

        $cart_id = $cartdetail->cart_id;
        // $itemcart->jumlah;

         // Saving links array to the session

        

        $itemuser = $request->user();
        $itemcart = Cart::where('user_id', $itemuser->id)
                        ->where('status_cart', 'cart')
                        ->first();
        $itemalamatpengiriman = AlamatPengiriman::where('user_id', $itemuser->id)
                                                // ->where('status', 'utama')
                                                ->first();
        if ($itemcart) {
            $data = array('title' => 'Checkout',
                        'itemcart' => $itemcart,
                        'total' => $total,
                        'cart_id' => $cart_id,
                        'itemalamatpengiriman' => $itemalamatpengiriman);
            return view('frontend.pages.checkout', $data)->with('no', 1);
        } else {
            return abort('404');
        }
    }
}
