<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    protected $table = 'produks';
    protected $fillable = [
        'kategori_id',
        'user_id',
        'kode_produk',
        'nama_produk',
        'slug_produk',
        'asal_produk',
        'image',
        'qty',
        'harga',
        'deskripsi',
        'status',
        // 'ongkir',
    ];

        public static function countActiveProduk(){
            $itemproduk= DB::table('produks')->count();
            if($itemproduk){
                return $itemproduk;
            }
            return 0;
        }

        public function kategori() {
            return $this->belongsTo('App\Kategori', 'kategori_id');
        }
    
        public function user() {
            return $this->belongsTo('App\User', 'user_id');
        }

        public function image()
        {
            if ($this->image && file_exists(public_path('assets/images/' . $this->image))) {
                return asset('assets/images/' . $this->image);
            } else {
                return asset('assets/no_image.png');
            }
    
        }
    
        public function delete_image()
        {
            if ($this->image && file_exists(public_path('assets/images/' . $this->image))) {
                return unlink(public_path('assets/images/' . $this->image));
            }
    
        }
}
