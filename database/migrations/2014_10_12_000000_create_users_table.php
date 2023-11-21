<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_posyandu')->length(20)->unsigned()->nullable();
            $table->string('name');
            $table->tinyInteger('role')->default(1);
            // $table->string('email');
            $table->string('password');
            $table->string('no_telp')->nullable();
            $table->bigInteger('nik')->unique()->length(20)->unsigned();
            $table->bigInteger('no_kk')->length(20)->unsigned()->nullable();
            $table->text('alamat')->nullable();
            $table->string('jenis_kelamin')->length(30)->nullable();
            $table->tinyInteger('is_delete')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // role : 1 => UserNormal, 2 => Kader, 3 => KaDes, 4 => Admin
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
