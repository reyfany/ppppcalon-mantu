<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey= 'id';
    protected $fillable = [
        'id',
        'user_id',
        'image_id',
        'no_invoice',
        'status_cart',
        'status_pembayaran',
        'status_pengiriman',
        'no_resi',
        'ekspedisi',
        'subtotal',
        'ongkir',
        'total',
        'image_id'
    ];

        public function user() {
            return $this->belongsTo('App\User','user_id');
        }

        public function produk() {
            return $this->hasMany('App\Produk', 'kategori_id');
        }
    
        public function detail() {
            return $this->hasMany('App\CartDetail', 'cart_id');
        }

        public function confirm() {
            return $this->hasOne('App\confirm', 'image');
        }
    
        public function updatetotal($itemcart, $subtotal) {
            $this->attributes['subtotal'] = $itemcart->subtotal + $subtotal;
            $this->attributes['total'] = $itemcart->total + $subtotal;
            self::save();
        }
}
