<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kategori_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('kode_produk');
            $table->string('nama_produk');
            $table->string('slug_produk');
            $table->text('deskripsi');
            $table->string('image')->nullable();
            $table->double('qty', 12, 2)->default(0);
            $table->double('harga', 12, 2)->default(0);
            // $table->double('ongkir', 12, 2)->default(0);
            $table->string('status');
            $table->string('asal_produk');
            $table->timestamps();
        });

        Schema::table('produks',function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
}
