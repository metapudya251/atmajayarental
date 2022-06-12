<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'tanda_pengenal'=> 'KTP',
            'no_customer'=>'CUS2022426 - 1',
            'no_pengenal'=> '340121250001012',
            'nama'=> 'Beno Surya',
            'alamat'=> 'Jalan Desa',
            'tgl_lahir'=> '1980-08-14',
            'gender'=> 'Laki-laki',
            'no_telp'=> '081231223123',
            'email'=> 'beno@gmail.com',
            'password'=> '$2a$12$L/ExnKfqn3zf82NV84SpUeRCu/G59jn5Kfs6f/4Fu6fsiFVkjB6lm', //Pass = 1980-08-14
            'status_verif'=>'Terverifikasi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('customers')->insert([
            'tanda_pengenal'=> 'KTP',
            'no_customer'=>'CUS2022426 - 1',
            'no_pengenal'=> '340121250001013',
            'nama'=> 'Gladis Viani',
            'alamat'=> 'Jalan Desa',
            'tgl_lahir'=> '2000-09-21',
            'gender'=> 'Perempuan',
            'no_telp'=> '08121224563',
            'email'=> 'viviani@gmail.com',
            'password'=> '$2a$12$eKKqy5wBWBOm4xWIzsKqBexRWR2RKS3VHTbxbu6wYt3TCoFdZqy4O', //Pass = 2000-09-21
            'status_verif'=>'Terverifikasi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
