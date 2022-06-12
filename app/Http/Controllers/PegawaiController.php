<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Role;
use App\Models\DetailJadwal;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    public function index(){    //untuk tampil halaman profil yg login
        $pegawai = Pegawai::all();
        return view('dashboard.pegawai.home',compact('pegawai'));
    }

    public function read(){     //untuk method search pegawai
        $pegawai = Pegawai::latest();
        if(request('search')){
            $pegawai->where('nama_pegawai', 'like', '%' . request('search') . '%');
        }
        return view('dashboard.pegawai.admin',['pegawai'=> $pegawai->get()]);
    }

    public function show($id){      //untuk liat detail pegawai
        $pegawai= Pegawai::find($id);
        return view('dashboard.pegawai.show', compact('pegawai'),[
            'role'=>Role::all()
        ]);
    }

    public function create()
    {
        return view('dashboard.pegawai.create',[
            'role'=>Role::all()
        ]);
    }

    public function store(Request $request){
        // return $request->file('img')->store('img');
        $request->validate([
            'role_id'=> 'required',
            'nama_pegawai'=> 'required|max:60',
            'alamat_pegawai'=> 'required',
            'tgl_lahir_pegawai'=> 'required|date',
            'noTelp_pegawai'=> 'required|min:10|max:13',
            'email'=> 'required|email:rfc,dns|unique:pegawais',
            'password'=> 'required|min:8|max:12',
            'img'=>'image|file|max:3072'
        ]);

        $request['password'] = bcrypt($request->password);
        $cek = Pegawai::count();
        if ($cek==0) {
            $urut = 190110000;
            $nomor = "PGW - " . $urut;
            $request['no_pegawai'] = $nomor;
        }else {
            $last = Pegawai::all()->last();
            $urut = $last->id + 1;
            // $urut = (int)substr($last->no_pegawai, -9) + 1;
            $nomor = "PGW - " . $urut;
            $request['no_pegawai'] = $nomor;
        }
        $pegawai = Pegawai::create($request->all());
        if ($request->hasfile('img')) {
            $request->file('img')->move('fotopgw/',$request->file('img')->getClientOriginalName());
            $pegawai->img = $request->file('img')->getClientOriginalName();
            $pegawai->save();
        }

        return redirect()->route('pegawai.read')   
            ->with('success','Item Created successfully.');
    }

    public function destroy($id){
        $pegawai = Pegawai::find($id);
        $pegawai->delete();

        return redirect()->route('pegawai.read')
                         ->with('success','Pegawai Deleted Successfully');

    }

    public function edit($id)
    {
        ///cari berdasarkan id
        $pegawai = Pegawai::find($id);
        ///menampilkan view edit dengan menyertakan data pegawai
        return view('dashboard.pegawai.profil',compact('pegawai'),[
            'role'=>Role::all()
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama_pegawai'=> 'required|max:60',
            'alamat_pegawai'=> 'required',
            'tgl_lahir_pegawai'=> 'required|date',
            'noTelp_pegawai'=> 'required|min:10|max:13',
            'email'=> 'required|email:rfc,dns',
            'img'=> 'image|file|max:3072'
        ]);

        $pegawai = Pegawai::find($id);
        if( $request['password'] = $pegawai->password){
            $request->password = $pegawai->password;
        }else {
            $request['password'] = $request->password;
        }
        Pegawai::find($id)->update($request->all());
        
        if ($request->hasfile('img')) {
            $request->file('img')->move('fotopgw/',$request->file('img')->getClientOriginalName());
            $pegawai->img = $request->file('img')->getClientOriginalName();
            $pegawai->save();
        }

        return redirect()->route('pegawai.index')  //ini kalo dilempar langsung ke bagian view
                         ->with('success','Profil Update Successfully.');
    }

    function check(Request $request){
        //Validate Inputs
        $request->validate([
           'email'=>'required|email|exists:pegawais,email',
           'password'=>'required|min:8|max:12'
        ],[
            'email.exists'=>'This email is not exists in pegawai table'
        ]);

        $creds = $request->only('email','password');

        if( Auth::guard('pegawai')->attempt($creds) ){
            return redirect()->route('pegawai.index');
        }else{
            return redirect()->route('pegawai.login')->with('fail','Incorrect credentials');
        }
   }

   function logout(){
        Auth::guard('pegawai')->logout();
        return redirect('/pegawai/login');
    }

}
