<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblPengerjaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pengerjaan', function (Blueprint $table) {
            $table->id('id_pengerjaan');
            $table->string('nama_mekanik') ->notNull();
            $table->date('tanggal_dikerjakan') ->notNull();
            $table->string('sparepart') ->notNull();
            $table->string('keterangan_pengerjaan');

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
