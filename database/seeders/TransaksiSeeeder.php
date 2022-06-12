<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class TransaksiSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaksis')->insert([
            'no_transaksi'=> 'TRN22051601-001',
            'customer_id'=> 001,
            'driver_id'=> 260122000,
            'pegawai_id'=> 190110000,
            'aset_id'=> 1,
            'no_ktp'=> '3406734563462',
            'no_sim'=> '1444-4565-6764',
            'tgl_transaksi'=> '2022-05-15 16:25:00',
            'tgl_waktu_mulai_sewa'=> '2022-05-16 08:25:59',
            'tgl_waktu_selesai_sewa'=> '2022-05-17 08:25:59',
            'tgl_pengembalian'=> '2022-05-17 07:25:59',
            'metode_pembayaran'=> 'Transfer',
            'jenis_transaksi'=> ' Penyewaan Mobil + Driver',
            'total_biaya_sewa'=> 300000,
            'status_pembayaran'=> 'Lunas',
            'status_transaksi'=> 'Selesai',
            'status_verifikasi'=> 'Verified',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('transaksis')->insert([
            'no_transaksi'=> 'TRN22051601-002',
            'customer_id'=> 002,
            'driver_id'=> 260122001,
            'pegawai_id'=> 190110001,
            'aset_id'=> 2,
            'no_ktp'=> '3406123463462',
            'no_sim'=> '1434-4565-6764',
            'tgl_transaksi'=> '2022-05-15 16:25:00', 
            'tgl_waktu_mulai_sewa'=> '2022-05-16 08:25:59',
            'tgl_waktu_selesai_sewa'=> '2022-05-17 08:25:59',
            'tgl_pengembalian'=> '2022-05-17 07:25:59',
            'metode_pembayaran'=> 'Transfer',
            'jenis_transaksi'=> ' Penyewaan Mobil + Driver',
            'total_biaya_sewa'=> 300000,
            'status_pembayaran'=> 'Belum Lunas',
            'status_transaksi'=> 'Belum Selesai',
            'status_verifikasi'=> 'Not Verified',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}