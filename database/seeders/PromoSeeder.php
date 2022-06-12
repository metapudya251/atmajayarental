<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promos')->insert([
            'kode_promo' => 'BDAY',
            'jenis_promo' => 'Ulang Tahun',
            'diskon_promo' => 0.15,
            'keterangan' => 'Promo bagi customer yang sedang berulang tahun',
            'status_promo' => 'Aktif',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('promos')->insert([
            'kode_promo' => 'MDK',
            'jenis_promo' => 'Mudik',
            'diskon_promo' => 0.25,
            'keterangan' => 'Promo berlaku selama masa libur Lebaran dan Nataru',
            'status_promo' => 'Tidak Aktif',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('promos')->insert([
            'kode_promo' => 'MHS',
            'jenis_promo' => 'Mahasiswa',
            'diskon_promo' => 0.20,
            'keterangan' => 'Promo bagi customer yang berusia mulai dari 17-22 tahun dan memiliki kartu identitas pelajar/mahasiswa',
            'status_promo' => 'Aktif',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
