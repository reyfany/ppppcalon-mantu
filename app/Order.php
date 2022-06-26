<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey= 'id';
    protected $fillable = [
        'cart_id',
        'nama_penerima',
        'no_tlp',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'kodepos',
        'image'
    ];

    public static function countActiveOrder(){
        $data= DB::table('orders')->count();
        if($data){
            return $data;
        }
        return 0;
    }
    public function user() {
        return $this->belongsTo('App\User','user_id');
    }
    
    public function cart() {
        return $this->belongsTo('App\Cart', 'cart_id', 'id');
    }

    // public function confirm() {
    //     return $this->belongsTo('App\confirm','image');
    // }

    public function confirm($id)
    {
      $confirm = confirm::where('order_id', $id)->first();
      return $confirm;
    }
}
