<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aset;
use App\Models\Pemilik;
use Carbon\Carbon;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aset = Aset::latest();
        if(request('search')){
            $aset->where('nama_mobil', 'like', '%' . request('search') . '%')
                  ->orWhere('status_tersedia', 'like', '%' . request('search') . '%')
                  ->orWhere('kategori_aset', 'like', '%' . request('search') . '%')
                  ->orWhere('jenis_transmisi', 'like', '%' . request('search') . '%');
        }
        $asets = Aset::all();
        $tgl = Carbon::now();
        foreach ($asets as $mobil){
            $contract = (int)((strtotime($mobil->periode_selesai_kontrak) - strtotime($tgl) )/86400);
            if ($contract > 30) {
                $mobil['status_kontrak'] = "On going";
                $mobil->save();
            }else {
                $mobil['status_kontrak'] = $contract . " days remaining";
                $mobil->save();
            }
        };
        
        return view('dashboard.aset.index',compact('contract'),[
            'aset'=> $aset->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.aset.create',[
            'pemilik'=>Pemilik::all()
        ]);
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
            'nama_mobil' => 'required',
            'tipe_mobil' => 'required',
            'jenis_transmisi' => 'required',
            'jenis_bahan_bakar' => 'required',
            'volume_bahan_bakar' => 'required',
            'warna_mobil' => 'required',
            'kapasitas_mobil' => 'required',
            'fasilitas_mobil' => 'required',
            'plat_nomor' => 'required|unique:asets',
            'no_stnk' => 'required|unique:asets',
            // 'kategori_aset' => 'required',
            'tanggal_service_akhir' => 'required',
            'status_tersedia' => 'required',
            'biaya_sewa' => 'required|numeric|min:100000',
        ]);

        if ($request->pemilik_id== 0){
            $request['pemilik_id'] = NULL;
            $request['kategori_aset'] = 'AJR';
        }else{
            $request['kategori_aset'] = 'Pribadi';
            $contract = (int)((strtotime($request->periode_selesai_kontrak) - strtotime($request->periode_mulai_kontrak))/86400);
            if ($contract > 30) {
                $request['status_kontrak'] = "On going";
            }else {
                $request['status_kontrak'] = $contract . "days remaining";
            }
        }

        $aset = Aset::create($request->all());
        if ($request->hasfile('img')) {
            $request->file('img')->move('fotoaset/',$request->file('img')->getClientOriginalName());
            $aset->img = $request->file('img')->getClientOriginalName();
            $aset->save();
        }

        // return redirect()->route('dashboard.pegawai.home')  //ini kalo dilempar langsung ke bagian view
        //                  ->with('success','Item Created successfully.');

        return redirect()->route('aset.index')   
            ->with('success','Aset Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aset = Aset::find($id);
        return view('dashboard.aset.show', compact('aset'),[
            'pemilik'=>Pemilik::all()
        ]);
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
        $aset = Aset::find($id);
        ///menampilkan view edit dengan menyertakan data aset
        return view('dashboard.aset.edit',compact('aset'),[
            'pemilik'=>Pemilik::all()
        ]);
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
            'nama_mobil' => 'required',
            'tipe_mobil' => 'required',
            'jenis_transmisi' => 'required',
            'jenis_bahan_bakar' => 'required',
            'volume_bahan_bakar' => 'required',
            'warna_mobil' => 'required',
            'kapasitas_mobil' => 'required',
            'fasilitas_mobil' => 'required',
            'plat_nomor' => 'required',
            'no_stnk' => 'required',
            'biaya_sewa' => 'required|numeric|min:100000',
        ]);

        if ($request->pemilik_id== 0){
            $request['pemilik_id'] = NULL;
            $request['kategori_aset'] = 'AJR';
        }else{
            $request['kategori_aset'] = 'Pribadi';
            $tgl = Carbon::now();
            $contract = (int)((strtotime($request->periode_selesai_kontrak) - strtotime($tgl) )/86400);
            if ($contract > 30) {
                $request['status_kontrak'] = "On going";
            }else {
                $request['status_kontrak'] = $contract . " days remaining";
            }
        }
        Aset::find($id)->update($request->all());
        $aset = Aset::find($id);
        if ($request->hasfile('img')) {
            $request->file('img')->move('fotoaset/',$request->file('img')->getClientOriginalName());
            $aset->img = $request->file('img')->getClientOriginalName();
            $aset->save();
        }

        return redirect()->route('aset.index')  //ini kalo dilempar langsung ke bagian controller
                         ->with('success','Aset Update Successfully.');
    }

    public function updateKategori(Request $request, $id)
    {
        $aset = Aset::find($id);
        $aset->kategori_aset = 'AJR';
        $aset->pemilik_id = NULL;
        $aset->periode_mulai_kontrak = NULL;
        $aset->periode_selesai_kontrak = NULL;
        $aset->save();
        return back();
    }

    // public function changeKategori(Request $request)
    // {
    //     $request->pemilik_id = NULL;
    //     $request->periode_mulai_kontrak = NULL;
    //     $request->periode_selesai_kontrak = NULL;
    //     // $request ->save();
    //     return back();
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aset = Aset::find($id);
        if ($aset->status_tersedia == 'Tidak Tersedia') {
            return redirect()->route('aset.index')
                         ->with('failed','Aset Deleted Unsuccessfull, Aset is being rented');
        }else {
            $aset->delete();
            return redirect()->route('aset.index')
                         ->with('success','Aset Deleted Successfully');
        }
    }
}
