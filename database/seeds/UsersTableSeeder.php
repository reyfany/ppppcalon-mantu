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
                'name'=>'Widya Handicraft',
                'email'=>'penjual@gmail.com',
                'password'=>Hash::make('2222'),
                'role'=>'penjual',
            ),
            // pembeli
            array(
                'name'=>'Wahyu Ryan',
                'email'=>'pembeli@gmail.com',
                'password'=>Hash::make('3333'),
                'role'=>'pembeli',
            ),
            array(
                'name'=>'Aulia Handicraft',
                'email'=>'penjual2@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
            array(
                'name'=>'Anyaman Bambu Kemarang',
                'email'=>'penjual3@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
            array(
                'name'=>'Cindy Ayu Handicraft',
                'email'=>'penjual4@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            )
        );
        DB::table('users')->insert($data);

        DB::table('kategoris')->insert([
            // 'kode_kategori' => '01',
            'nama_kategori' => 'testing1',
            'slug_kategori' => 'testing',
            'deskripsi' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim adipisci maiores in! Maiores non odit aliquam, sequi ad commodi harum ex nulla. Dolorem modi dolor nesciunt aut reiciendis, quia adipisci.',
            'status' => 'active',
            'user_id' => '2',
        ]);

        DB::table('slideshows')->insert([
            'id' => '1',
            'foto' => '1694143793.jpg',
            'user_id' => '1',
        ]);
    }
}
