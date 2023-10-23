<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_barang', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('nama_barang')->notNull();
            $table->string('No_inventaris_peralatan')->unique();
            $table->string('lokasi_barang')->notNull();

            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
