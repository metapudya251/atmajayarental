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
        Schema::create('pemiliks', function (Blueprint $table) {
            $table->id()->from(1100);
            $table->string('no_ktp')->unique();
            $table->string('nama_pemilik');
            $table->string('alamat_pemilik');
            $table->string('noTelp_pemilik');
            $table->string('status')->nullable(); //masih aktif engga
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
        Schema::dropIfExists('pemiliks');
    }
};
