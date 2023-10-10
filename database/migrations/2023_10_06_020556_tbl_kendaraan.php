<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblKendaraan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kendaraan', function (Blueprint $table) {
            $table->id('id_kendaraan');
            $table->string('no_polisi') ->notNull();
            $table->date('tanggal_masuk_bengkel') ->notNull();
            $table->date('tanggal_selesai')->nullable();

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
