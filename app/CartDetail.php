<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $table = 'cart_details';
    protected $fillable = [
        'produk_id',
        'cart_id',
        'qty',
        'harga',
        // 'diskon',
        'subtotal',
    ];

    public function cart() {
        return $this->belongsTo('App\Cart', 'cart_id');
    }

    public function produk() {
        return $this->belongsTo('App\Produk', 'produk_id');
    }

    // function untuk update qty, sama subtotal
    public function updatedetail($itemdetail, $qty, $harga) {
        $this->attributes['qty'] = $itemdetail->qty + $qty;
        $this->attributes['subtotal'] = $itemdetail->subtotal + ($qty * $harga);
        self::save();
    }
}
