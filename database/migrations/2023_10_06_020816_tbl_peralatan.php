<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblPeralatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_peralatan', function (Blueprint $table) {
            $table->id('id_peralatan');
            $table->string('merek') ->notNull();
            $table->string('No_inventaris_peralatan') ->notNull();
            $table->string('nama_karyawan');
            $table->string('alat_rusak') ->notNull();
            $table->date('tanggal_dikerjakan') ->notNull();
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
