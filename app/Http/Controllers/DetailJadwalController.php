<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DetailJadwal;
use App\Models\Jadwal;
use App\Models\Pegawai;
use Carbon\Carbon;

class DetailJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $detail = DetailJadwal::latest();
        $detail = DetailJadwal::join('pegawais', 'pegawais.id', '=', 'detail_jadwals.pegawai_id')
                            ->join('jadwals', 'jadwals.id', '=', 'detail_jadwals.jadwal_id')
                            ->select('detail_jadwals.*', 'pegawais.nama_pegawai','pegawais.role_id', 'jadwals.waktu_shift_mulai', 'jadwals.waktu_shift_selesai')
                            ->orderBy('detail_jadwals.created_at', 'desc');
        if(request('search')){
            $detail->where('detail_jadwals.hari_shift', 'like', '%' . request('search') . '%')
                  ->orWhere('pegawais.nama_pegawai','like', '%' . request('search') . '%' )
                  ->orWhere('jadwals.id', 'like', '%' . request('search') . '%');
        }
        return view('dashboard.jadwal.index',[
            'detail'=> $detail->get(),
            'details'=>$detail->get(),
            'jadwal'=>$detail->get(),
            'jadwals'=>$detail->get(),
            'shift'=>$detail->get(),
            'shifts'=>$detail->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.jadwal.create',[
            'jadwal'=>Jadwal::all(),
            'pegawai'=>Pegawai::all()
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
            'hari_shift'=> 'required',
            'jadwal_id'=> 'required',
            'pegawai_id'=> 'required'
        ]);

        $detail = DetailJadwal::join('pegawais', 'pegawais.id', '=', 'detail_jadwals.pegawai_id')
                            ->join('jadwals', 'jadwals.id', '=', 'detail_jadwals.jadwal_id')
                            ->select('detail_jadwals.*', 'pegawais.id', 'jadwals.id')->get();
        foreach ($detail as $jadwal){
            
            if (($request->jadwal_id == $jadwal->jadwal->id) && ($request->pegawai_id == $jadwal->pegawai_id) && ($request->hari_shift == $jadwal->hari_shift)) {
                return back()->with('failed','Jadwal Created Unsuccessfully. Jadwal has been added');
            }
            $count = DetailJadwal::where('pegawai_id', 'like', '%' . $request->pegawai_id . '%')->count();
            if ($count > 5) {
                return back()->with('fail','Jadwal Created Unsuccessfully. Shift cannot be more than 6');
            }
        };
        DetailJadwal::create($request->all());
        return redirect()->route('jadwal.index')   
                        ->with('success','Jadwal Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = DetailJadwal::find($id);
        return view('dashboard.jadwal.show', compact('detail'));
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
        $detail = DetailJadwal::find($id);
        ///menampilkan view edit dengan menyertakan data promo
        return view('dashboard.jadwal.edit',compact('detail'),[
            'jadwal'=>Jadwal::all(),
            'pegawai'=>Pegawai::all()
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
            'hari_shift'=> 'required',
            'jadwal_id'=> 'required',
        ]);

        $detail = DetailJadwal::join('pegawais', 'pegawais.id', '=', 'detail_jadwals.pegawai_id')
                            ->join('jadwals', 'jadwals.id', '=', 'detail_jadwals.jadwal_id')
                            ->select('detail_jadwals.*', 'pegawais.id', 'jadwals.id')->get();
        foreach ($detail as $jadwal){
            if (($request->jadwal_id == $jadwal->jadwal->id) && ($request->hari_shift == $jadwal->hari_shift)) {
                // dd($jadwal->jadwal_id);
                return back()->with('failed','Jadwal Created Unsuccessfully. Jadwal has been added');
            }
        };

        DetailJadwal::find($id)->update($request->all());

        return redirect()->route('jadwal.index')  //ini kalo dilempar langsung ke bagian controller
                         ->with('success','Jadwal Update Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = DetailJadwal::find($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')
                         ->with('success','Jadwal Deleted Successfully');
    }
}
