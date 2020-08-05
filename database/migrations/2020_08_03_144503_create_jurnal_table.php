<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kelas_id')->unsigned();
            $table->integer('jam');
            $table->date('date');
            $table->integer('mapel_id')->unsigned();
            $table->integer('guru_id')->unsigned();
            $table->text('materi');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->index('kelas_id');
            $table->index('mapel_id');
            $table->index('guru_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jurnal', function (Blueprint $table) {
            //
        });
    }
}
