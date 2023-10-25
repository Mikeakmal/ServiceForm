<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKondisiToTblPeralatanrusak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_peralatanrusak', function (Blueprint $barang) {    
            // Menambah kolom baru
            $barang->string('kondisi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_peralatanrusak', function (Blueprint $table) {
            //
        });
    }
}
