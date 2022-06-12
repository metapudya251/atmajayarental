<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Aset;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index(){    //untuk tampil halaman dashboard 
        $customer = Customer::all();
        $aset = Aset::latest();
        if(request('search')){
            $aset->where('nama_mobil', 'like', '%' . request('search') . '%')
                  ->orWhere('tipe_mobil', 'like', '%' . request('search') . '%')
                  ->orWhere('jenis_transmisi', 'like', '%' . request('search') . '%');
        }
        return view('dashboard.customer.index',compact('customer'),[
            'aset'=> $aset->get()
        ]);
    }

    public function read(){     //untuk method search pegawai
        $customer = Customer::latest();
        if(request('search')){
            $customer->where('nama', 'like', '%' . request('search') . '%');
        }
        return view('dashboard.customer.cs',['customer'=> $customer->get()]);
    }

    public function show($id){      //untuk liat detail pegawai
        $customer= Customer::find($id);
        return view('dashboard.customer.show', compact('customer'));
    }

    public function create()
    {
        return view('dashboard.customer.create');
    }

    public function store(Request $request){
        $request->validate([
            'tanda_pengenal'=> 'required',
            'no_pengenal'=> 'required',
            'nama'=> 'required',
            'alamat'=> 'required',
            'tgl_lahir'=> 'required|date',
            'gender'=> 'required',
            'no_telp'=> 'required|digits_between:10,13|numeric|unique:customers',
            'email'=> 'required|email:rfc,dns|unique:customers'
        ]);

        $request['password'] = bcrypt($request->tgl_lahir);
        // $request['password'] = ($request->tgl_lahir);
        $count = Customer::count();
        $tgl = Carbon::now()->format('Y-m-d');
        $now = Carbon::now();
        $ymd = $now->year . $now->month . $now->day; 
        if ($count==0) {
            $urut = 000;
            $nomor = 'CUS' . $ymd .' - ' . $urut;
            $request['no_customer'] = $nomor;
        }else {
            $last = Customer::all()->last();
            $urut = $last->id + 1;
            $nomor = 'CUS' . $ymd .' - ' . $urut;
            $request['no_customer'] = $nomor;
        }
        Customer::create($request->all());

        return redirect()->route('customer.read')   
            ->with('success','Item Created successfully.');
    }

    public function destroy($id){
        $customer = Customer::find($id);
        $customer->delete();

        return redirect()->route('customer.read')
                         ->with('success','Customer Deleted Successfully');

    }

    public function edit($id)
    {
        ///cari berdasarkan id
        $customer = Customer::find($id);
        ///menampilkan view edit dengan menyertakan data pegawai
        return view('dashboard.customer.edit',compact('customer'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'tanda_pengenal'=> 'required',
            'no_pengenal'=> 'required',
            'nama'=> 'required',
            'alamat'=> 'required',
            'gender'=> 'required',
            'tgl_lahir'=> 'required|date',
            'no_telp'=> 'required|digits_between:10,13|numeric',
            'email'=> 'required|email:rfc,dns',
            'password'=> 'required|min:8'
        ]);

        $customer = Customer::find($id);
        // $request['password'] = bcrypt($request->password);
        if( $request['password'] = $customer->password){
            $request->password = $customer->password;
        }else {
            $request['password'] = $request->password;
        }
        Customer::find($id)->update($request->all());
        
        if ($request->hasfile('img')) {
            $request->file('img')->move('fotocust/',$request->file('img')->getClientOriginalName());
            $customer->img = $request->file('img')->getClientOriginalName();
            $customer->save();
        }

        return redirect()->route('customer.profil')  //ini kalo dilempar langsung ke bagian view
                         ->with('success','Customer Update Successfully.');
    }

    function check(Request $request){
        //Validate Inputs
        $request->validate([
           'email'=>'required|email|exists:customers,email',
           'password'=>'required|min:8|max:12'
        ],[
            'email.exists'=>'This email is not exists in pegawai table'
        ]);

        $creds = $request->only('email','password');

        if( Auth::guard('customer')->attempt($creds) ){
            return redirect()->route('customer.index');
        }else{
            return redirect()->route('customer.login')->with('fail','Incorrect credentials');
        }
   }

   function add(Request $request){
        //Validate inputs
        $request->validate([
            'tanda_pengenal'=> 'required',
            'no_pengenal'=> 'required',
            'nama'=> 'required',
            'alamat'=> 'required',
            'gender'=> 'required',
            'tgl_lahir'=> 'required|date',
            'no_telp'=> 'required|digits_between:10,13|numeric|unique:customers',
            'email'=> 'required|email:rfc,dns|unique:customers'
        ]);

        $customer = new Customer();
        $customer->tanda_pengenal = $request->tanda_pengenal;
        $customer->no_pengenal = $request->no_pengenal;
        $customer->nama = $request->nama;
        $customer->alamat = $request->alamat;
        $customer->tgl_lahir = $request->tgl_lahir;
        $customer->gender = $request->gender;
        $customer->no_telp = $request->no_telp;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->tgl_lahir);

        $count = Customer::count();
        $tgl = Carbon::now()->format('Y-m-d');
        $now = Carbon::now();
        $ymd = $now->year . $now->month . $now->day; 
        if ($count==0) {
            $urut = 000;
            $nomor = 'CUS' . $ymd .' - ' . $urut;
            // $request['no_customer'] = $nomor;
            $customer->no_customer = $nomor;
        }else {
            $last = Customer::all()->last();
            $urut = $last->id + 1;
            $nomor = 'CUS' . $ymd .' - ' . $urut;
            // $request['no_customer'] = $nomor;
            $customer->no_customer = $nomor;
        }
        // $customer->password = $request->tgl_lahir;
        $save = $customer->save();

        if( $save ){
            return redirect()->back()->with('success','You are now registered successfully as Customer');
        }else{
            return redirect()->back()->with('fail','Something went Wrong, failed to register');
        }
    }

    function logoutC(){
        Auth::guard('customer')->logout();
        return redirect('/customer/login');
    }

}
