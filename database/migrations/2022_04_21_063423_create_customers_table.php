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
        Schema::create('customers', function (Blueprint $table) {
            $table->id()->from(001);
            $table->string('no_customer')->nullable();
            $table->string('tanda_pengenal');
            $table->string('no_pengenal');
            $table->string('nama');
            $table->string('alamat');
            $table->date('tgl_lahir');
            $table->string('gender');
            $table->string('no_telp');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken()->nullable();
            $table->string('img')->nullable();
            $table->string('status_verif')->nullable();
            $table->string('status')->nullable();  //aktif atau tidak
            $table->timestamps();
        });
        DB::statement('ALTER TABLE customers CHANGE id id INT(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
