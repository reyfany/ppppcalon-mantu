<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
        'slug_kategori',
        'deskripsi',
        'status',
        'user_id'
    ];


    public static function countActiveKategori(){
        $data= DB::table('kategoris')->count();
        if($data){
            return $data;
        }
        return 0;
    }

    public function user() {//user yang menginput data kategori
        return $this->belongsTo('App\User', 'user_id');
    }

    public function produk() {
        return $this->hasMany('App\Produk', 'kategori_id');
    }
}
