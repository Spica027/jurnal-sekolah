<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_siswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('jurnal_id')->unsigned();
            $table->integer('siswa_id')->unsigned();
            $table->string('keterangan');

            $table->index('jurnal_id');
            $table->index('siswa_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jurnal_siswa', function (Blueprint $table) {
            //
        });
    }
}
