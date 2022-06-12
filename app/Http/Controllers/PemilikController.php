<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemilik;
use App\Models\Aset;
use Carbon\Carbon;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemilik = Pemilik::latest();
        if(request('search')){
            $pemilik->where('nama_pemilik', 'like', '%' . request('search') . '%')
                  ->orWhere('no_ktp', 'like', '%' . request('search') . '%');
        }
        return view('dashboard.pemilik.index',[
            'pemilik'=> $pemilik->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pemilik.create');
    }
    public function add()
    {
        return view('dashboard.pemilik.add');
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
            'nama_pemilik'=> 'required|max:60',
            'no_ktp'=> 'required|unique:pemiliks',
            'alamat_pemilik'=> 'required',
            'noTelp_pemilik'=> 'required|digits_between:10,13|numeric|unique:pemiliks',
        ]);

        Pemilik::create($request->all());

        return redirect()->route('pemilik.index')   
            ->with('success','Pemilik Created successfully.');
    }
    public function new(Request $request)
    {
        $request->validate([
            'nama_pemilik'=> 'required|max:60',
            'no_ktp'=> 'required|unique:pemiliks',
            'alamat_pemilik'=> 'required',
            'noTelp_pemilik'=> 'required|digits_between:10,13|numeric|unique:pemiliks',
        ]);

        Pemilik::create($request->all());

        return redirect()->route('aset.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pemilik = Pemilik::find($id);
        $aset = Aset::where('pemilik_id', 'like', '%' . $pemilik->id . '%')->get();
        $tgl = Carbon::now();
        // echo $tgl->toDateTimeString();
        foreach ($aset as $mobil){
            $contract = (int)((strtotime($mobil->periode_selesai_kontrak) - strtotime($tgl) )/86400);
            if ($contract > 30) {
                $mobil['status_kontrak'] = "On going";
                $mobil->save();
            }else {
                $mobil['status_kontrak'] = $contract . " days remaining";
                $mobil->save();
            }
        };
        return view('dashboard.pemilik.show', compact('pemilik', 'aset'));
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
        $pemilik = Pemilik::find($id);
        ///menampilkan view edit dengan menyertakan data pemilik
        return view('dashboard.pemilik.edit',compact('pemilik'));
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
            'nama_pemilik'=> 'required|max:60',
            'no_ktp'=> 'required',
            'alamat_pemilik'=> 'required',
            'noTelp_pemilik'=> 'required|digits_between:10,13|numeric',
        ]);

        Pemilik::find($id)->update($request->all());

        return redirect()->route('pemilik.index')  //ini kalo dilempar langsung ke bagian controller
                         ->with('success','Pemilik Update Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemilik = Pemilik::find($id);
        $count = Aset::where('pemilik_id', 'like', '%' . $pemilik->id . '%')->count();
        if ($count == 0) {
            $pemilik->delete();
            return redirect()->route('pemilik.index')
                            ->with('success','Pemilik Deleted Successfully');
        } else {
            return redirect()->route('pemilik.index')
                            ->with('failed','Pemilik Deleted Unsuccessfully');
        }
    }
}
