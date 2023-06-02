<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();

        if(count($customers) > 0){
            // return view ('pegawai/tampil-pegawai',compact('pegawais'));
            return response([
                'message' => 'Retrieve All Success',
                'data' => $customers
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id){
        $customers= Customer::find($id);

        if(!is_null($customers)){
            return response([
                'message' => 'Retrieve Course Success',
                'data' => $customers
            ], 200);
        }

        return response([
            'message' => 'Course Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'tanda_pengenal'=> 'required',
            'no_pengenal'=> 'required',
            'nama'=> 'required',
            'alamat'=> 'required',
            'tgl_lahir'=> 'required|date',
            'gender'=> 'required',
            'no_telp'=> 'required|digits_between:10,13|numeric|unique:customers',
            'email'=> 'required|email:rfc,dns|unique:customers',
            'password'=> 'required',
            'img'=> ''
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $storeData['password'] = bcrypt($request->password);
        $customers = Customer::create($storeData);
        return response([
            'message' => 'Add Course Success',
            'data' => $customers
        ], 200);
    }

    public function destroy($id){
        $customers = Customer::find($id);

        if(is_null($customers)){
            return response([
                'message' => 'Course Not Found',
                'data' => null
            ], 404);
        }

        if($customers->delete()){
            return response([
                'message' => 'Delete course Success',
                'data' =>$customers
            ],200);
        }

        return response([
            'message' => 'Delete Course Success',
            'data' =>null,
        ], 400);

    }

    public function update(Request $request, $id){
        $customers = Customer::find($id);
        if(is_null($customers)){
            return response([
                'message' => 'Course Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'tanda_pengenal'=> 'required',
            'no_pengenal'=> 'required',
            'nama'=> 'required',
            'alamat'=> 'required',
            'tgl_lahir'=> 'required|date',
            'gender'=> 'required',
            'no_telp'=> ['required', 'digits_between:10,13', 'numeric', Rule::unique('customers')->ignore($customers)],
            'email'=>  ['required','email:rfc,dns', Rule::unique('customers')->ignore($customers)],
            'img'=> ''
        ]);

        if($validate->fails())
            return response(['message' => $validate ->errors()], 400);

        $customers->nama = $updateData['nama'];
        $customers->alamat = $updateData['alamat'];
        $customers->tgl_lahir = $updateData['tgl_lahir'];
        $customers->gender = $updateData['gender'];
        $customers->no_telp = $updateData['no_telp'];
        $customers->email = $updateData['email'];
        $customers->img = $updateData['img'];

        $updateData['password'] = bcrypt($request->password);
        $customers->password = $updateData['password'];

        if($customers->save()){
            return response([
                'message' => 'Update Course Success',
                'data' => $customers
            ], 200);
        }

        return response([
            'message' => 'Update Course failed',
            'data' => null,
        ], 400);
    }

    public function login($email,$password)
    {
        //$loginData = $request->all();
        $loginData['email'] = $email;
        $loginData['password'] = $password;
        $validate = Validator::make($loginData, [
            'email' => 'required',
            'password' => 'required'
        ]); // membuat rule validasi input

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400); // return error validasi input
        
        if (!Auth::guard('customer')->attempt($loginData))
            return response(['message' => 'Invalid Credentials'], 401); // return error gagal login

        $user = Auth::guard('customer')->user();

        return response([
            'message' => 'true',
            'user' => $user
        ]); // return data user dalam bentuk json
    } 
}
