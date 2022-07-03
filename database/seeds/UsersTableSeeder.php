<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{ 
    public function run()
    {
        $data=array(
            // admin
            array(
                'name'=>'Admin',
                // 'name_umkm'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('1111'),
                'role'=>'admin',
            ),
            // penjual
            array(
                'name'=>'Penjual',
                'email'=>'penjual@gmail.com',
                'password'=>Hash::make('2222'),
                'role'=>'penjual',
            ),
            // pembeli
            array(
                'name'=>'Pembeli',
                'email'=>'pembeli@gmail.com',
                'password'=>Hash::make('3333'),
                'role'=>'pembeli',
            ),
            array(
                'name'=>'Pembeli2',
                'email'=>'pembeli2@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'pembeli',
            ),
            array(
                'name'=>'Penjual2',
                'email'=>'penjual2@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
        );
        DB::table('users')->insert($data);

        DB::table('kategoris')->insert([
            'kode_kategori' => '01',
            'nama_kategori' => 'testing1',
            'slug_kategori' => 'testing',
            'deskripsi' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim adipisci maiores in! Maiores non odit aliquam, sequi ad commodi harum ex nulla. Dolorem modi dolor nesciunt aut reiciendis, quia adipisci.',
            'status' => 'active',
            'user_id' => '2',
        ]);
    }
}
