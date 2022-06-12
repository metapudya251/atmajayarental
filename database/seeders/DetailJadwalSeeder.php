<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class DetailJadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detail_jadwals')->insert([
            'hari_shift' => 'Selasa',
            'jadwal_id' => 1,
            'pegawai_id' => 190110000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('detail_jadwals')->insert([
            'hari_shift' => 'Rabu',
            'jadwal_id' => 2,
            'pegawai_id' => 190110001,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('detail_jadwals')->insert([
            'hari_shift' => 'Selasa',
            'jadwal_id' => 1,
            'pegawai_id' => 190110002,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
