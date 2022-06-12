<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi')->nullable();
            $table->integer('customer_id')->unsigned()->length(3);
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->unsignedBigInteger('pegawai_id')->nullable();
            $table->foreign('pegawai_id')->references('id')->on('pegawais');
            $table->unsignedBigInteger('aset_id');
            $table->foreign('aset_id')->references('id')->on('asets');
            $table->string('no_ktp')->nullable();
            $table->string('no_sim')->nullable();
            $table->dateTime('tgl_transaksi');
            $table->dateTime('tgl_waktu_mulai_sewa');
            $table->dateTime('tgl_waktu_selesai_sewa');
            $table->string('metode_pembayaran');
            $table->dateTime('tgl_pengembalian')->nullable();
            $table->string('jenis_transaksi');
            $table->float('ekstensi_biaya')->nullable();
            $table->float('total_biaya_sewa')->nullable();
            $table->string('status_pembayaran')->nullable();
            $table->string('status_transaksi')->nullable(); // untuk mengetahui apakah selsai/on going atau molor
            $table->string('status_verifikasi')->nullable();
            $table->integer('rating_driver')->nullable();
            $table->string('file')->nullable();  //upload file sim dan ktp
            $table->string('buktiBayar')->nullable();
            $table->unsignedBigInteger('promo_id')->nullable();
            $table->foreign('promo_id')->references('id')->on('promos');
            $table->float('subAset')->nullable();
            $table->float('subDriver')->nullable();
            $table->float('subTot')->nullable();
            $table->float('disc')->nullable();
            $table->float('selisihTgl')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE transaksis CHANGE customer_id customer_id INT(3) UNSIGNED ZEROFILL');
        DB::statement('ALTER TABLE transaksis CHANGE id id INT(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};
