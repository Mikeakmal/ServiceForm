<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblPeralatanrusak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_peralatanrusak', function (Blueprint $table) {
            $table->id('id_peralatan');
            $table->string('merek') ->notNull();
            $table->string('nama_karyawan');
            $table->string('alat_rusak') ->notNull();
            $table->date('tanggal_diperbaiki') ->notNull();
            $table->string('nama_teknisi') ->notNull();

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
