<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Promo;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promo = Promo::latest();
        if(request('search')){
            $promo->where('jenis_promo', 'like', '%' . request('search') . '%')
                  ->orWhere('status_promo', 'like', '%' . request('search') . '%')
                  ->orWhere('kode_promo', 'like', '%' . request('search') . '%');
        }
        return view('dashboard.promo.index',[
            'promo'=> $promo->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.promo.create');
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
            'kode_promo'=> 'required|unique:promos',
            'jenis_promo'=> 'required',
            'diskon_promo'=> 'required|min:0|max:1|numeric',
            'keterangan'=> 'required',
            'status_promo'=> 'required'
        ]);

        Promo::create($request->all());

        // return redirect()->route('dashboard.pegawai.home')  //ini kalo dilempar langsung ke bagian view
        //                  ->with('success','Item Created successfully.');

        return redirect()->route('promo.index')   
            ->with('success','Promo Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promo = Promo::find($id);
        return view('dashboard.promo.show', compact('promo'));
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
        $promo = Promo::find($id);
        ///menampilkan view edit dengan menyertakan data promo
        return view('dashboard.promo.edit',compact('promo'));
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
            // 'kode_promo'=> 'required',
            'jenis_promo'=> 'required',
            'diskon_promo'=> 'required|min:0|max:1|numeric',
            'keterangan'=> 'required',
            'status_promo'=> 'required'
        ]);

        Promo::find($id)->update($request->all());

        return redirect()->route('promo.index')  //ini kalo dilempar langsung ke bagian controller
                         ->with('success','Promo Update Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promo = Promo::find($id);
        $promo->delete();

        return redirect()->route('promo.index')
                         ->with('success','Promo Deleted Successfully');
    }
}
