<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Driver;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driver = Driver::latest();
        if(request('search')){
            $driver->where('nama_driver', 'like', '%' . request('search') . '%')
                  ->orWhere('no_driver', 'like', '%' . request('search') . '%');
        }
        return view('dashboard.driver.index',[
            'driver'=> $driver->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.driver.create');
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
            'nama_driver'=> 'required',
            'alamat_driver'=> 'required',
            'tgl_lahir_driver'=> 'required',
            'gender_driver'=> 'required',
            'no_telp_driver'=> 'required|digits_between:10,13|numeric|unique:drivers',
            'email'=> 'required|email:rfc,dns',
            'password'=> 'required|min:8|max:12',
            'status_tersedia'=> 'required',
            'bahasa'=> 'required',
            'biaya_driver'=> 'required'
        ]);

        $request['password'] = bcrypt($request->password);
        $cek = Driver::count();
        if ($cek==0) {
            $urut = 260122000;
            $nomor = "DRV - " . $urut;
            $request['no_driver'] = $nomor;
        }else {
            $last = Driver::all()->last();
            $urut = $last->id + 1;
            $nomor = "DRV - " . $urut;
            $request['no_driver'] = $nomor;
        }
        $driver = Driver::create($request->all());
        if ($request->hasfile('img')) {
            $request->file('img')->move('fotodriver/',$request->file('img')->getClientOriginalName());
            $driver->img = $request->file('img')->getClientOriginalName();
            $driver->save();
        }

        return redirect()->route('driver.index')   
            ->with('success','Driver Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $driver = Driver::find($id);
        return view('dashboard.driver.show', compact('driver'));
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
        $driver = Driver::find($id);
        ///menampilkan view edit dengan menyertakan data driver
        return view('dashboard.driver.edit',compact('driver'));
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
            // 'nama_driver'=> 'required',
            // 'alamat_driver'=> 'required',
            // 'tgl_lahir_driver'=> 'required',
            // 'gender_driver'=> 'required',
            // 'no_telp_driver'=> 'required|digits_between:10,13|numeric',
            // 'email'=> 'required|email:rfc,dns',
            // 'password'=> 'required|min:8|max:12',
            'status_tersedia'=> 'required',
            'bahasa'=> 'required'
        ]);

        $request['password'] = bcrypt($request->password);
        Driver::find($id)->update($request->all());
        $driver = Driver::find($id);
        if ($request->hasfile('img')) {
            $request->file('img')->move('fotodriver/',$request->file('img')->getClientOriginalName());
            $driver->img = $request->file('img')->getClientOriginalName();
            $driver->save();
        }

        return redirect()->route('driver.index')  //ini kalo dilempar langsung ke bagian controller
                         ->with('success','Driver Update Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $driver = Driver::find($id);
        $driver->delete();

        return redirect()->route('driver.index')
                         ->with('success','Driver Deleted Successfully');
    }
}
