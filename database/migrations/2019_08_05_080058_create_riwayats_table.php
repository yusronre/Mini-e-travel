<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiwayatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->Increments('id');
            $table->Integer('id_destinasi');
            $table->string('destinasi');
            $table->Integer('hari');
            $table->Integer('orang');
            $table->Integer('id_hotel');
            $table->string('category');
            $table->Integer('jumlah_ruangan');
            $table->Integer('total');
            $table->Integer('id_user');
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
        Schema::dropIfExists('riwayats');
    }
}
