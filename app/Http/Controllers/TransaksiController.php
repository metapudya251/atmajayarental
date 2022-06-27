<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aset;
use App\Models\Pemilik;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\Promo;
use App\Models\Transaksi;
use App\Models\Pegawai;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //tampil data awal sebelum di veri
    {    //jangan lupa join table nya
        $transaksi = Transaksi::where('status_verifikasi', 'like', '%' . "Not Verified". '%');
        if(request('search')){
            $transaksi->where('no_transaksi', 'like', '%' . request('search') . '%');
        }
        return view('dashboard.transaksi.indexVerif',[
            'transaksi'=> $transaksi->get()
        ]);
    }
    public function indexCust() //tampil data awal sebelum di veri
    {    //jangan lupa join table nya
        $transaksi = Transaksi::where('status_verifikasi', 'like', '%' . "Not Verified". '%')
                            ->where('status_transaksi', 'like', '%' . "Belum Selesai". '%')
                            ->orWhere('status_pembayaran', 'like', '%' . "Belum Lunas". '%')
                            ->orWhere('status_pembayaran', 'like', '%' . "Lunas Menunggu Verifikasi". '%');
        if(request('search')){
            $transaksi->where('no_transaksi', 'like', '%' . request('search') . '%');
        }
        return view('dashboard.transaksi.indexCust',[
            'transaksi'=> $transaksi->get()
        ]);
    }
    public function indexTransaksi() //tampil data awal setelah di verif, transaksi on going
    {
        $transaksi = Transaksi::where('status_verifikasi', '=',"Verified")
                                ->where('status_transaksi', 'like', '%' . "Belum Selesai". '%')
                                ->orWhere('status_pembayaran', 'like', '%' . "Belum Lunas". '%')
                                ->orWhere('status_pembayaran', 'like', '%' . "Lunas Menunggu Verifikasi". '%');
        if(request('search')){
            $transaksi->where('no_transaksi', 'like', '%' . request('search') . '%');
        }
        return view('dashboard.transaksi.index',[
            'transaksi'=> $transaksi->get()
        ]);
    }
    public function history()    //tampil data selesai semua
    {
        $transaksi = Transaksi::where('status_transaksi', '=' , "Selesai")
                            ->where('status_pembayaran', '=',  "Lunas")
                            ->where('status_verifikasi', '=',"Verified");
        if(request('search')){
            $transaksi->where('no_transaksi', 'like', '%' . request('search') . '%');
        }
        return view('dashboard.transaksi.history',[
            'transaksi'=> $transaksi->get()
        ]);
    }
    public function custHistory()    //tampil data selesai semua
    {
        $transaksi = Transaksi::where('status_transaksi', '=' , "Selesai")
                            ->where('status_pembayaran', '=',  "Lunas")
                            ->where('status_verifikasi', '=',"Verified");
        if(request('search')){
            $transaksi->where('no_transaksi', 'like', '%' . request('search') . '%');
        }
        return view('dashboard.transaksi.custHistory',[
            'transaksi'=> $transaksi->get()
        ]);
    }

    /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */
    public function create($id)
    {
        $mobil = Aset::find($id);
        return view('dashboard.transaksi.create',[
            'aset'=>Aset::all(),
            'pegawai'=>Pegawai::all(),
            'driver'=>Driver::all(),
            'promo'=>Promo::all(),
            'customer'=>Customer::all()
        ])->with('mobil', $mobil);
    }

    /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
    public function store(Request $request)
    {
        $request->validate([
            'aset_id'=> 'required',
            'tgl_transaksi'=> 'required',
            'tgl_waktu_mulai_sewa'=> 'required',
            'tgl_waktu_selesai_sewa'=> 'required',
            'metode_pembayaran'=> 'required',
            'file'=> 'required|file|max:3072',
        ]);

        $request['status_transaksi'] = 'Belum Selesai';
        $request['status_pembayaran'] = 'Belum Lunas';
        $request['status_verifikasi'] = 'Not Verified';

        $count = Transaksi::count();
        $tgl = Carbon::now()->format('Y-m-d');
        $now = Carbon::now();
        $year = substr( $now->year, -2);
        $month = str_pad($now->month, 2, "0", STR_PAD_LEFT);
        $day = $now->day;
        
        $ymd = $year . $month . $day; 
        if ($count==0) {
            if ($request->jenis_transaksi == "Penyewaan Mobil + Driver") {
                $urut = 000;
                $nomor = 'TRN' . $ymd . '01' .' - ' .  $urut;
                $request['no_customer'] = $nomor;
            } else {
                $urut = 000;
                $nomor = 'TRN' . $ymd . '02' .' - ' .  $urut;
                $request['no_customer'] = $nomor;
            }
        }else {
            if ($request->jenis_transaksi == "Penyewaan Mobil + Driver") {
                $last = Transaksi::all()->last();
                $urut = $last->id + 1;
                $nomor = 'TRN' . $ymd . '01' .' - ' .  $urut;
                $request['no_transaksi'] = $nomor;
            } else {
                $last = Transaksi::all()->last();
                $urut = $last->id + 1;
                $nomor = 'TRN' . $ymd . '02' .' - ' .  $urut;
                $request['no_transaksi'] = $nomor;
            }
        }

        //Set Status aset
        $aset = Aset::find($request->aset_id);
        $aset->status_tersedia = 'Tidak Tersedia';
        $aset->save();

        //Itung selisih tgl
        $to = Carbon::parse($request->tgl_waktu_mulai_sewa);
        $from = Carbon::parse($request->tgl_waktu_selesai_sewa);
        $diff = $to->diff($from);
        $request['selisihTgl'] = $diff->d;

        if ($request->promo_id == 0) {
            $request['promo_id'] = NULL;
        }
        $request['ekstensi_biaya'] = 0;

        $transaksi = Transaksi::create($request->all());
        
        //set driver
        if ($transaksi->driver_id != NULL) {
            $drv = Driver::find($transaksi->driver_id);
            $drv->status_tersedia = 'Tidak Tersedia';
            $drv->save();
        }

        if ($request->hasfile('file')) {
            $request->file('file')->move('filecust/',$request->file('file')->getClientOriginalName());
            $transaksi->file = $request->file('file')->getClientOriginalName();
            $transaksi->save();
        }

        //itung subtotal aset
        $transaksi->subAset = $diff->d*$transaksi->aset->biaya_sewa;
        $transaksi->save();
        //itung subtotal driver
        if ($transaksi->driver_id != NULL) {
            $transaksi->subDriver = $diff->d*$transaksi->driver->biaya_driver;
            $transaksi->save();
        }else{
            $transaksi->subDriver = 0;
            $transaksi->save();
        }
        //itung subtotal all
        $transaksi->subTot = $transaksi->subAset + $transaksi->subDriver;
        $transaksi->save();

        //itung disc
        if ($transaksi->promo_id != NULL) {
            $transaksi->disc = $transaksi->promo->diskon_promo*$transaksi->subTot;
            $transaksi->save();
        }else{
            $transaksi->disc = 0;
            $transaksi->save();
        }
        //total sementara
        $transaksi->total_biaya_sewa = $transaksi->subTot - $transaksi->disc;
        $transaksi->save();

        return redirect()->route('transaksi.indexCust')   
            ->with('success','Transaksi Created successfully.');
    }

    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function showVerif($id)
    {
        $transaksi = Transaksi::find($id);
        return view('dashboard.transaksi.showVerif', compact('transaksi'));
    }
    public function showHistory($id)
    {
        $transaksi = Transaksi::find($id);
        return view('dashboard.transaksi.showHistory', compact('transaksi'));
    }
    public function show($id)
    {
        $transaksi = Transaksi::find($id);
        return view('dashboard.transaksi.show', compact('transaksi'));
    }

    public function showNota($id)
    {
        $transaksi = Transaksi::find($id);
        //hitung denda
        $a = Carbon::parse($transaksi->tgl_waktu_selesai_sewa);
        $b = Carbon::parse($transaksi->tgl_pengembalian);
        $diff = $a->diff($b);
        
        $selisih = (int)((strtotime($b) - strtotime($a)));
        $hour = floor($selisih / (60 * 60));
        // dd($hour);
        if ($hour > 3) { //lebih dari 3 jam
            if ($diff->d > 1) {     //lebih dari 1 hari
                $dendaM = $transaksi->aset->biaya_sewa*$diff->d;
                if ($transaksi->driver_id != NULL) {
                    $dendaD = $transaksi->driver->biaya_driver*$diff->d;
                    $transaksi->ekstensi_biaya = $dendaM + $dendaD;
                }else{
                    $transaksi->ekstensi_biaya = $dendaM;
                }
                $transaksi->save();
            } else {
                $dendaM = $transaksi->aset->biaya_sewa;
                if ($transaksi->driver_id != NULL) {
                    $dendaD = $transaksi->driver->biaya_driver;
                    // dd($dendaD);
                    $transaksi->ekstensi_biaya = $dendaM + $dendaD;
                    // dd($transaksi->ekstensi_biaya);
                }else{
                    $transaksi->ekstensi_biaya = $dendaM;
                    // dd($dendaM);
                }
                $transaksi->save();
            }
        }else {
            $dendaM = 0;
            $dendaD = 0;
            $transaksi->ekstensi_biaya = $dendaM + $dendaD;
            $transaksi->save();
        }
        
        //total
        $transaksi->total_biaya_sewa = $transaksi->subTot - $transaksi->disc + $transaksi->ekstensi_biaya;
        $transaksi->save();
        
        return view('dashboard.transaksi.showNota', compact('transaksi'));
    }

    public function showCust($id)
    {
        $transaksi = Transaksi::find($id);
        //hitung denda
        if ($transaksi->tgl_pengembalian != NULL) {
            $a = Carbon::parse($transaksi->tgl_waktu_selesai_sewa);
            $b = Carbon::parse($transaksi->tgl_pengembalian);
            $diff = $a->diff($b);
            
            $selisih = (int)((strtotime($b) - strtotime($a)));
            $hour = floor($selisih / (60 * 60));
            // dd($hour);
            if ($hour > 3) { //lebih dari 3 jam
                if ($diff->d > 1) {     //lebih dari 1 hari
                    $dendaM = $transaksi->aset->biaya_sewa*$diff->d;
                    if ($transaksi->driver_id != NULL) {
                        $dendaD = $transaksi->driver->biaya_driver*$diff->d;
                        $transaksi->ekstensi_biaya = $dendaM + $dendaD;
                    }else{
                        $transaksi->ekstensi_biaya = $dendaM;
                    }
                    $transaksi->save();
                } else {
                    $dendaM = $transaksi->aset->biaya_sewa;
                    if ($transaksi->driver_id != NULL) {
                        $dendaD = $transaksi->driver->biaya_driver;
                        // dd($dendaD);
                        $transaksi->ekstensi_biaya = $dendaM + $dendaD;
                        // dd($transaksi->ekstensi_biaya);
                    }else{
                        $transaksi->ekstensi_biaya = $dendaM;
                        // dd($dendaM);
                    }
                    $transaksi->save();
                }
            }else {
                $dendaM = 0;
                $dendaD = 0;
                $transaksi->ekstensi_biaya = $dendaM + $dendaD;
                $transaksi->save();
            }
            
            //total
            $transaksi->total_biaya_sewa = $transaksi->subTot - $transaksi->disc + $transaksi->ekstensi_biaya;
            $transaksi->save();
        }
        
        return view('dashboard.transaksi.showCust', compact('transaksi'));
    }
    public function showCust2($id)
    {
        $transaksi = Transaksi::find($id);
        //hitung denda
        if ($transaksi->tgl_pengembalian != NULL) {
            $a = Carbon::parse($transaksi->tgl_waktu_selesai_sewa);
            $b = Carbon::parse($transaksi->tgl_pengembalian);
            $diff = $a->diff($b);
            
            $selisih = (int)((strtotime($b) - strtotime($a)));
            $hour = floor($selisih / (60 * 60));
            // dd($hour);
            if ($hour > 3) { //lebih dari 3 jam
                if ($diff->d > 1) {     //lebih dari 1 hari
                    $dendaM = $transaksi->aset->biaya_sewa*$diff->d;
                    if ($transaksi->driver_id != NULL) {
                        $dendaD = $transaksi->driver->biaya_driver*$diff->d;
                        $transaksi->ekstensi_biaya = $dendaM + $dendaD;
                    }else{
                        $transaksi->ekstensi_biaya = $dendaM;
                    }
                    $transaksi->save();
                } else {
                    $dendaM = $transaksi->aset->biaya_sewa;
                    if ($transaksi->driver_id != NULL) {
                        $dendaD = $transaksi->driver->biaya_driver;
                        // dd($dendaD);
                        $transaksi->ekstensi_biaya = $dendaM + $dendaD;
                        // dd($transaksi->ekstensi_biaya);
                    }else{
                        $transaksi->ekstensi_biaya = $dendaM;
                        // dd($dendaM);
                    }
                    $transaksi->save();
                }
            }else {
                $dendaM = 0;
                $dendaD = 0;
                $transaksi->ekstensi_biaya = $dendaM + $dendaD;
                $transaksi->save();
            }
            
            //total
            $transaksi->total_biaya_sewa = $transaksi->subTot - $transaksi->disc + $transaksi->ekstensi_biaya;
            $transaksi->save();
        }
        
        return view('dashboard.transaksi.cust', compact('transaksi'));
    }

    public function cetakNota($id)
    {
        $transaksi = Transaksi::find($id);
        
        view()->share('transaksi',$transaksi);
        $pdf = PDF::loadview('dashboard.transaksi.notak');
        return $pdf->stream('nota-AJR.pdf');
    }
    public function cetakNota1($id)
    {
        $transaksi = Transaksi::find($id);
        return view('dashboard.transaksi.nota', compact('transaksi'));
    }

    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function edit($id)
    {
        ///cari berdasarkan id
        $transaksi = Transaksi::find($id);
        ///menampilkan view edit dengan menyertakan data promo
        return view('dashboard.transaksi.edit',compact('transaksi'),[
            'aset'=>Aset::all(),
            'pegawai'=>Pegawai::all(),
            'driver'=>Driver::all(),
            'promo'=>Promo::all(),
            'customer'=>Customer::all()
        ]);
    }
    public function editBayar($id)
    {
        ///cari berdasarkan id
        $transaksi = Transaksi::find($id);
        ///menampilkan view edit dengan menyertakan data promo
        return view('dashboard.transaksi.transfer',compact('transaksi'));
    }

    public function updateVerif(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->status_verifikasi = 'Verified';
        $transaksi->pegawai_id = Auth::guard('pegawai')->user()->id;
        $transaksi->save();
        return redirect()->route('transaksi.index')   
            ->with('success','Transaksi Verify successfully.');
    }
    public function updateStatus(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->status_transaksi = 'Selesai';
        $transaksi->tgl_pengembalian = Carbon::now();
        $transaksi->save();

        $aset = Aset::find($transaksi->aset_id);
        $aset->status_tersedia = 'Tersedia';
        $aset->save();

        $driver = Driver::find($transaksi->driver_id);
        $driver->status_tersedia = 'Tersedia';
        $driver->save();

        return back();
    }
    public function updateBayar(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->status_pembayaran = 'Lunas';
        $transaksi->pegawai_id = Auth::guard('pegawai')->user()->id;
        $transaksi->save();
        return back();
    }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'file'=> 'file|max:3072',
        ]);
        // $transaksi->no_sim = $request['no_sim'];
        if ($request->promo_id == NULL) {
            $request['promo_id'] == NULL;
        }
        Transaksi::find($id)->update($request->all());
        $transaksi = Transaksi::find($id);
        if ($request->hasfile('file')) {
            $request->file('file')->move('filecust/',$request->file('file')->getClientOriginalName());
            $transaksi->file = $request->file('file')->getClientOriginalName();
            $transaksi->save();
        }
        return redirect()->route('transaksi.indexCust')  //ini kalo dilempar langsung ke bagian controller
                            ->with('success','Transaksi Update Successfully.');
    }
    public function updateBukti(Request $request, $id)
    {
        $request->validate([
            'buktiBayar'=> 'file|max:3072',
        ]);
        
        // Transaksi::find($id)->update($request->all());
        $transaksi = Transaksi::find($id);
        if ($request->hasfile('buktiBayar')) {
            $request->file('buktiBayar')->move('bukti/',$request->file('buktiBayar')->getClientOriginalName());
            $transaksi->buktiBayar = $request->file('buktiBayar')->getClientOriginalName();
            $transaksi->save();
        }
        $transaksi->status_pembayaran = 'Lunas Menunggu Verifikasi';
        $transaksi->save();
        
        return redirect()->route('transaksi.indexCust')  //ini kalo dilempar langsung ke bagian controller
                            ->with('success','Transaksi Update Successfully.');
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function destroy($id)
    {
        $promo = Transaksi::find($id);
        $promo->delete();

        return redirect()->route('transaksi.indexCust')
                            ->with('success','Transaksi Deleted Successfully');
    }
}
