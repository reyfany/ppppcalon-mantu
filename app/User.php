<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        // 'name_umkm',
        'photo',
        'email',
        'password',
        'alamat',
        'phone',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // memanggil data dinamis tabel users pada dashboard
    public static function countActiveUser(){
        $data= DB::table('users')->count();
        if($data){
            return $data;
        }
        return 0;
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