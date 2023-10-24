<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAndAddColumnsInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_barang', function (Blueprint $barang) {    
            // Menambah kolom baru
            $barang->string('kondisi');
            $barang->string('tanggal_pengambilan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table', function (Blueprint $table) {
            //
        });
    }
}
