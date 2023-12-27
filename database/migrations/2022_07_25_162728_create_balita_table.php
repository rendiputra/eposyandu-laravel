<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalitaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balita', function (Blueprint $table) {
            $table->id('id_balita');
            $table->bigInteger('id_posyandu')->length(20)->unsigned();
            $table->string('nama');
            $table->bigInteger('nik')->length(20)->unsigned()->unique();
            $table->bigInteger('no_kk')->unsigned()->length(20);
            $table->bigInteger('nik_ibu')->unsigned()->length(20);
            $table->string('nama_ibu');
            $table->bigInteger('nik_ayah')->unsigned()->length(20);
            $table->string('nama_ayah');
            $table->string('jenis_kelamin')->length(30);
            $table->date('tanggal_lahir');
            $table->float('berat_badan_lahir')->length(20);
            $table->float('tinggi_badan_lahir')->length(20);
            $table->tinyInteger('is_deleted')->default(0);
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
        Schema::dropIfExists('balita');
    }
}
