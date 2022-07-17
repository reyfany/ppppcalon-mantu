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
            array(
                'name'=>'Penjual3',
                'email'=>'penjual3@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
            array(
                'name'=>'Penjual4',
                'email'=>'penjual4@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
            array(
                'name'=>'Penjual5',
                'email'=>'penjual5@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
            array(
                'name'=>'Penjual6',
                'email'=>'penjual6@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
            array(
                'name'=>'Penjual7',
                'email'=>'penjual7@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
            array(
                'name'=>'Penjual8',
                'email'=>'penjual8@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
            array(
                'name'=>'Penjual9',
                'email'=>'penjual9@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
            array(
                'name'=>'Penjual10',
                'email'=>'penjual10@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
            array(
                'name'=>'Penjual11',
                'email'=>'penjual11@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
            array(
                'name'=>'Penjual12',
                'email'=>'penjual12@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
            array(
                'name'=>'Penjual13',
                'email'=>'penjual13@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
            array(
                'name'=>'Penjual14',
                'email'=>'penjual14@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
            array(
                'name'=>'Penjual15',
                'email'=>'penjual15@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=>'penjual',
            ),
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
    }
}
