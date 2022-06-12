<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index(){
        $drivers = Driver::all();

        if(count($drivers) > 0){
            // return view ('pegawai/tampil-pegawai',compact('pegawais'));
            return response([
                'message' => 'Retrieve All Success',
                'data' => $drivers
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id){
        $drivers= Driver::find($id);

        if(!is_null($drivers)){
            return response([
                'message' => 'Retrieve Course Success',
                'data' => $drivers
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
            'nama_driver'=> 'required',
            'alamat_driver'=> 'required',
            'tgl_lahir_driver'=> 'required',
            'gender_driver'=> 'required',
            'no_telp_driver'=> 'required|digits_between:10,13|numeric|unique:drivers',
            'email'=> 'required|email:rfc,dns|unique:drivers',
            'password'=> 'required|min:8|max:12',
            'bahasa'=> 'required'
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $storeData['password'] = bcrypt($request->password);
        $drivers = Driver::create($storeData);
        return response([
            'message' => 'Add Course Success',
            'data' => $drivers
        ], 200);
    }

    public function destroy($id){
        $drivers = Driver::find($id);

        if(is_null($drivers)){
            return response([
                'message' => 'Course Not Found',
                'data' => null
            ], 404);
        }

        if($drivers->delete()){
            return response([
                'message' => 'Delete course Success',
                'data' =>$drivers
            ],200);
        }

        return response([
            'message' => 'Delete Course Success',
            'data' =>null,
        ], 400);

    }

    public function update(Request $request, $id){
        $drivers = Driver::find($id);
        if(is_null($drivers)){
            return response([
                'message' => 'Course Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_driver'=> 'required',
            'alamat_driver'=> 'required',
            'tgl_lahir_driver'=> 'required',
            'gender_driver'=> 'required',
            'no_telp_driver'=> ['required', 'digits_between:10,13', 'numeric', Rule::unique('drivers')->ignore($drivers)],
            'email'=> ['required','email:rfc,dns', Rule::unique('drivers')->ignore($drivers)],
            'password'=> '',
            'bahasa'=> 'required',
            'img'=> ''
        ]);

        if($validate->fails())
            return response(['message' => $validate ->errors()], 400);

        $drivers->nama_driver = $updateData['nama_driver'];
        $drivers->alamat_driver = $updateData['alamat_driver'];
        $drivers->tgl_lahir_driver = $updateData['tgl_lahir_driver'];
        $drivers->gender_driver = $updateData['gender'];
        $drivers->no_telp_driver = $updateData['no_telp_driver'];
        $drivers->email = $updateData['email'];
        $drivers->bahasa= $updateData['bahasa'];
        $drivers->img= $updateData['img'];

        $updateData['password'] = bcrypt($request->password);
        $drivers->password = $updateData['password'];

        if($drivers->save()){
            return response([
                'message' => 'Update Course Success',
                'data' => $drivers
            ], 200);
        }

        return response([
            'message' => 'Update Course failed',
            'data' => null,
        ], 400);
    }
}
