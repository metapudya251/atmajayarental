<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drivers')->insert([
            'no_driver'=> 'DRV-260121999',
            'nama_driver'=> 'Raja W.',
            'alamat_driver'=> 'Jalan',
            'tgl_lahir_driver'=> '1980-08-14',
            'gender_driver'=> 'Laki-laki',
            'no_telp_driver'=> '08123456789',
            'email'=> 'raja@driver.com',
            'password'=> '$2a$12$i4N8axMcD7WzJHpZ4KSpP.K3agWSIykHS2JMZVcWLw16vXL/LMLVO', //Pass = 12345678
            'status_tersedia'=> 'Tersedia',
            'bahasa'=> 'Indonesia',
            'biaya_driver'=> '50000',
            'status_verif'=> 'Terverififikasi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('drivers')->insert([
            'no_driver'=> 'DRV-260122000',
            'nama_driver'=> 'Fanya Nirmala',
            'alamat_driver'=> 'Jalan',
            'tgl_lahir_driver'=> '1980-08-14',
            'gender_driver'=> 'Perempuan',
            'no_telp_driver'=> '08123126789',
            'email'=> 'fanya@driver.com',
            'password'=> '$2a$12$i4N8axMcD7WzJHpZ4KSpP.K3agWSIykHS2JMZVcWLw16vXL/LMLVO', //Pass = 12345678
            'status_tersedia'=> 'Tidak Tersedia',
            'bahasa'=> 'Indonesia',
            'biaya_driver'=> '50000',
            'status_verif'=> 'Terverififikasi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
