<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class AsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('asets')->insert([
            'nama_mobil' => 'Avanza',
            'tipe_mobil' => 'MPV',
            'jenis_transmisi' => 'AT',
            'jenis_bahan_bakar' => 'Pertamax',
            'volume_bahan_bakar' => 1.3,
            'warna_mobil' => 'Merah',
            'kapasitas_mobil' => 4,
            'fasilitas_mobil' => 'AC, Airbag',
            'plat_nomor' => 'AB1235DK',
            'no_stnk' => '2400278190023',
            'kategori_aset' => 'Pribadi',
            'tanggal_service_akhir' => '2022-03-01',
            'status_tersedia' => 'Tersedia',
            'biaya_sewa' => 250000,
            'pemilik_id' => 1100,
            'periode_mulai_kontrak'=> '2022-04-14',
            'periode_selesai_kontrak'=> '2022-07-14',
            'status_kontrak'=> 'On Going',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('asets')->insert([
            'nama_mobil' => 'Rush',
            'tipe_mobil' => 'MPV',
            'jenis_transmisi' => 'MT',
            'jenis_bahan_bakar' => 'Pertamax',
            'volume_bahan_bakar' => 1.3,
            'warna_mobil' => 'Putih',
            'kapasitas_mobil' => 4,
            'fasilitas_mobil' => 'AC, Airbag',
            'plat_nomor' => 'AB1275DK',
            'no_stnk' => '2412378190023',
            'kategori_aset' => 'Pribadi',
            'tanggal_service_akhir' => '2022-03-01',
            'status_tersedia' => 'Tersedia',
            'biaya_sewa' => 250000,
            'pemilik_id' => 1101,
            'periode_mulai_kontrak'=> '2022-04-15',
            'periode_selesai_kontrak'=> '2022-07-15',
            'status_kontrak'=> 'On Going',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}


