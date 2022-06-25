<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_kategori');
            $table->string('nama_kategori');
            $table->string('slug_kategori');
            $table->string('deskripsi');
            $table->string('status');
            $table->integer('user_id')->unsigned();//user yang menginput kategori
            $table->timestamps();
        });

        Schema::table('kategoris',function(Blueprint $table){
        $table->foreign('user_id')->references('id')->on('users');
    });
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategoris');
    }
}
