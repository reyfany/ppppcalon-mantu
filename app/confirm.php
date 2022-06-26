<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class confirm extends Model
{
    protected $guarded = [];
    protected $table = 'confirms';
    protected $primaryKey= 'id';

    protected $fillable = [
        'cart_id',
        'user_id',
        'order_id',
        'image',
    ];


    public function user() {
        return $this->belongsTo('App\User','user_id');
    }

    public function Order() {
        return $this->hasMany('App\Order');
    }
}
