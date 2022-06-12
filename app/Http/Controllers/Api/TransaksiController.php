<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Customer;
use App\Models\Transaksi;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(){
        $transaksi = Transaksi::join('customers', 'customers.id', '=', 'transaksis.customer_id')
                            ->join('asets', 'asets.id', '=', 'transaksis.aset_id')
                            ->select('transaksis.*','customers.nama','transaksis.total_biaya_sewa','asets.nama_mobil')
                            ->get();

        if(count($transaksi) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $transaksi
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }
    public function history(){
        $transaksi = Transaksi::join('customers', 'customers.id', '=', 'transaksis.customer_id')
                            ->join('asets', 'asets.id', '=', 'transaksis.aset_id')
                            ->select('transaksis.*','customers.nama','transaksis.total_biaya_sewa','asets.nama_mobil')
                            ->where('status_transaksi', '=' , "Selesai")
                            ->where('status_pembayaran', '=',  "Lunas")
                            ->where('status_verifikasi', '=',"Verified")
                            ->get();

        if(count($transaksi) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $transaksi
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }
    public function historyDrv(){
        $transaksi = Transaksi::join('customers', 'customers.id', '=', 'transaksis.customer_id')
                            ->join('asets', 'asets.id', '=', 'transaksis.aset_id')
                            ->join('drivers', 'drivers.id', '=', 'transaksis.driver_id')
                            ->select('transaksis.*','customers.nama','transaksis.total_biaya_sewa','asets.nama_mobil', 'drivers.nama_driver')
                            ->where('status_transaksi', '=' , "Selesai")
                            ->where('status_pembayaran', '=',  "Lunas")
                            ->where('status_verifikasi', '=',"Verified")
                            ->where('driver_id', '!=',"NULL")
                            ->get();

        if(count($transaksi) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $transaksi
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function incomeMobil(Request $request){
        $transaksi = Transaksi::join('asets', 'transaksis.aset_id', '=', 'asets.id')
                    ->select('asets.tipe_mobil', 'asets.nama_mobil', DB::raw('count(transaksis.no_transaksi) as jumlah_peminjaman, SUM(transaksis.total_biaya_sewa) as pendapatan'))->groupByRaw('asets.nama_mobil, asets.tipe_mobil');
        
        if ($request->keyword) {
            $transaksi->whereMonth('transaksis.tgl_transaksi', $request->keyword)
                    ->orwhereYear('transaksis.tgl_transaksi', $request->keyword);
        }
        $tr = $transaksi->get();
        if(count($tr) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $tr
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }
    // public function incomeMobil(){
    //     $transaksi = DB::table('transaksis')
    //                 ->join('asets', 'transaksis.aset_id', '=', 'asets.id')
    //                 ->select(DB::raw('asets.tipe_mobil as tipe_mobil, asets.nama_mobil as nama_mobil,count(transaksis.no_transaksi) as jumlah_peminjaman, SUM(transaksis.total_biaya_sewa) as pendapatan'))
    //                 ->whereMonth('transaksis.tgl_transaksi', '05')
    //                 ->whereYear('transaksis.tgl_transaksi', '2022')
    //                 ->groupByRaw('asets.nama_mobil, asets.tipe_mobil')
    //                 ->get();

    //     if(count($transaksi) > 0){
    //         return response([
    //             'message' => 'Retrieve All Success',
    //             'data' => $transaksi
    //         ], 200);
    //     }

    //     return response([
    //         'message' => 'Empty',
    //         'data' => null
    //     ], 400);
    // }

    public function incomeCust(){
        $transaksi = DB::table('transaksis')
                    ->join('customers', 'transaksis.customer_id', '=', 'customers.id')
                    ->join('asets', 'transaksis.aset_id', '=', 'asets.id')
                    ->select(DB::raw('customers.nama, asets.nama_mobil, transaksis.jenis_transaksi, count(transaksis.no_transaksi) as jumlah_peminjaman, SUM(transaksis.total_biaya_sewa) as pendapatan'))
                    ->whereMonth('transaksis.tgl_transaksi', '05')
                    ->whereYear('transaksis.tgl_transaksi', '2022')
                    ->groupByRaw('transaksis.jenis_transaksi, customers.nama, asets.nama_mobil')
                    ->get();

        if(count($transaksi) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $transaksi
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }
    public function top5driver(){
        $transaksi = DB::table('transaksis')
                    ->join('drivers', 'transaksis.driver_id', '=', 'drivers.id')
                    ->select(DB::raw('drivers.no_driver, drivers.nama_driver, count(transaksis.no_transaksi) as jumlah_peminjaman'))
                    ->whereMonth('transaksis.tgl_transaksi', '05')
                    ->whereYear('transaksis.tgl_transaksi', '2022')
                    ->groupByRaw('drivers.no_driver, drivers.nama_driver')
                    ->limit(5)
                    ->get();

        if(count($transaksi) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $transaksi
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }
    public function top5cust(){
        $transaksi = DB::table('transaksis')
                    ->join('customers', 'transaksis.customer_id', '=', 'customers.id')
                    ->select(DB::raw('customers.no_customer, customers.nama, count(transaksis.no_transaksi) as jumlah_peminjaman'))
                    ->whereMonth('transaksis.tgl_transaksi', '05')
                    ->whereYear('transaksis.tgl_transaksi', '2022')
                    ->groupByRaw('customers.no_customer, customers.nama')
                    ->limit(5)
                    ->get();

        if(count($transaksi) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $transaksi
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id){
        $transaksi = Transaksi::find($id);

        if(!is_null($transaksi)){
            return response([
                'message' => 'Retrieve Course Success',
                'data' => $transaksi
            ], 200);
        }

        return response([
            'message' => 'Course Not Found',
            'data' => null
        ], 404);
    }

    public function destroy($id){
        $transaksi = Transaksi::find($id);

        if(is_null($transaksi)){
            return response([
                'message' => 'Course Not Found',
                'data' => null
            ], 404);
        }

        if($transaksi->delete()){
            return response([
                'message' => 'Delete course Success',
                'data' =>$transaksi
            ],200);
        }

        return response([
            'message' => 'Delete Course Success',
            'data' =>null,
        ], 400);

    }
}
