<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class PemilikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pemiliks')->insert([
            'no_ktp'=> '3412190500010234',
            'nama_pemilik'=> 'Vera',
            'alamat_pemilik'=> 'Jalan',
            'noTelp_pemilik'=> '08123126789',
            'status'=> 'Aktif',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('pemiliks')->insert([
            'no_ktp'=> '3412290500030234',
            'nama_pemilik'=> 'Bowo',
            'alamat_pemilik'=> 'Jalan',
            'noTelp_pemilik'=> '08123870489',
            'status'=> 'Aktif',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
