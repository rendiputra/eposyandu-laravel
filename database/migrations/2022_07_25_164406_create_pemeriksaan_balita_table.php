<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanBalitaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaan_balita', function (Blueprint $table) {
            $table->id('id_pemeriksaan_balita');
            $table->bigInteger('id_balita')->length(20)->unsigned();
            $table->bigInteger('id_posyandu')->length(20)->unsigned();
            $table->bigInteger('id_user_petugas')->length(20)->unsigned();
            $table->float('berat_badan')->length(20);
            $table->float('tinggi_badan')->length(20);
            $table->float('lingkar_lengan_atas')->length(20);
            $table->float('lingkar_kepala')->length(20);
            $table->string('status_stunting')->length(20);
            $table->string('status_berat_badan')->length(20);
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
        Schema::dropIfExists('pemeriksaan_balita');
    }
}
