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
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->string('tipe_mobil');
            $table->string('jenis_transmisi');
            $table->string('jenis_bahan_bakar');
            $table->float('volume_bahan_bakar');
            $table->string('warna_mobil');
            $table->integer('kapasitas_mobil');
            $table->string('fasilitas_mobil');
            $table->string('plat_nomor')->unique();
            $table->string('no_stnk');
            $table->string('kategori_aset');
            $table->date('tanggal_service_akhir');
            $table->string('status_tersedia');
            $table->float('biaya_sewa');
            $table->unsignedBigInteger('pemilik_id')->nullable();
            $table->foreign('pemilik_id')->references('id')->on('pemiliks');
            $table->date('periode_mulai_kontrak')->nullable();
            $table->date('periode_selesai_kontrak')->nullable();
            $table->string('status_kontrak')->nullable();
            $table->string('img')->nullable();
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
        Schema::dropIfExists('asets');
    }
};
