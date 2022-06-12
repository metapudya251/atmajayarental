<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id()->from(260122000);
            $table->string('no_driver');
            $table->string('nama_driver');
            $table->string('alamat_driver');
            $table->date('tgl_lahir_driver');
            $table->string('gender_driver');
            $table->string('no_telp_driver')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status_tersedia');
            $table->string('bahasa');
            $table->float('biaya_driver');
            $table->string('img')->nullable();
            $table->string('dokumen_driver')->nullable();
            $table->string('status_verif')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('drivers');
    }
};
