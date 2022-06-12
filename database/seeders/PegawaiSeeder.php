<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawais')->insert([
            'role_id'=> 1,
            'no_pegawai'=> 'PGW - 190110000',
            'nama_pegawai'=> 'Bima Karunia',
            'alamat_pegawai'=> 'Jalan Jaya Sehat',
            'tgl_lahir_pegawai'=> '1980-08-14',
            'gender_pegawai'=> 'Laki-laki',
            'noTelp_pegawai'=> '081231223123',
            'email'=> 'bima14@manager.com',
            // 'password'=> '$2a$12$DyDHLI2Pq8g.c.geFoAqKunaqlhS3qBe3QCj6IN2RoikK9VuGXdD.', //Pass = 123
            'password'=> '$2a$12$i4N8axMcD7WzJHpZ4KSpP.K3agWSIykHS2JMZVcWLw16vXL/LMLVO', //Pass = 12345678
            'status'=> 'Aktif',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('pegawais')->insert([
            'role_id'=> 2,
            'nama_pegawai'=> 'Mahesa',
            'no_pegawai'=> 'PGW - 190110001',
            'alamat_pegawai'=> 'Jalan Jaya Sehat',
            'tgl_lahir_pegawai'=> '1980-08-14',
            'gender_pegawai'=> 'Laki-laki',
            'noTelp_pegawai'=> '081264123123',
            'email'=> 'mahe14@admin.com',
            'password'=> '$2a$12$i4N8axMcD7WzJHpZ4KSpP.K3agWSIykHS2JMZVcWLw16vXL/LMLVO', //Pass = 12345678
            'status'=> 'Aktif',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('pegawais')->insert([
            'role_id'=> 3,
            'no_pegawai'=> 'PGW - 190110002',
            'nama_pegawai'=> 'Annisa Rahma',
            'alamat_pegawai'=> 'Perum Peruman',
            'tgl_lahir_pegawai'=> '1988-10-18',
            'gender_pegawai'=> 'Perempuan',
            'noTelp_pegawai'=> '08123623123',
            'email'=> 'ann18@custservis.com',
            'password'=> '$2a$12$i4N8axMcD7WzJHpZ4KSpP.K3agWSIykHS2JMZVcWLw16vXL/LMLVO', //Pass = 12345678
            'status'=> 'Aktif',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
