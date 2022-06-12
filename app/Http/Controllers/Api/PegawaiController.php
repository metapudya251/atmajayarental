<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index(){
        $pegawais = Pegawai::all();

        if(count($pegawais) > 0){
            // return view ('pegawai/tampil-pegawai',compact('pegawais'));
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pegawais
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id){
        $pegawai= Pegawai::find($id);

        if(!is_null($pegawai)){
            return response([
                'message' => 'Retrieve Course Success',
                'data' => $pegawai
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
            'role_id'=> 'required',
            'nama_pegawai'=> 'required|max:60',
            'alamat_pegawai'=> 'required',
            'gender_pegawai'=> 'required',
            'noTelp_pegawai'=> 'required',
            'tgl_lahir_pegawai'=> 'required|date',
            'email'=> 'required|email:rfc,dns|unique:pegawais',
            'password'=> 'required',
            'img'=> ''
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $storeData['password'] = bcrypt($request->password_pegawai);
        $pegawai = Pegawai::create($storeData);
        return response([
            'message' => 'Add Course Success',
            'data' => $pegawai
        ], 200);
    }

    public function destroy($id){
        $pegawai = Pegawai::find($id);

        if(is_null($pegawai)){
            return response([
                'message' => 'Course Not Found',
                'data' => null
            ], 404);
        }

        if($pegawai->delete()){
            return response([
                'message' => 'Delete course Success',
                'data' =>$pegawai
            ],200);
        }

        return response([
            'message' => 'Delete Course Success',
            'data' =>null,
        ], 400);

    }

    public function update(Request $request, $id){
        $pegawai = Pegawai::find($id);
        if(is_null($pegawai)){
            return response([
                'message' => 'Course Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'role_id'=> 'required',
            'nama_pegawai'=> 'required|max:60',
            'alamat_pegawai'=> 'required',
            'gender_pegawai'=> 'required',
            'noTelp_pegawai'=> 'required',
            'tgl_lahir_pegawai'=> 'required|date',
            'email'=> ['required','email:rfc,dns', Rule::unique('pegawais')->ignore($pegawai)],
            'img'=> ''
        ]);

        if($validate->fails())
            return response(['message' => $validate ->errors()], 400);

        $pegawai->role_id = $updateData['role_id'];
        $pegawai->nama_pegawai = $updateData['nama_pegawai'];
        $pegawai->alamat_pegawai = $updateData['alamat_pegawai'];
        $pegawai->tgl_lahir_pegawai = $updateData['tgl_lahir_pegawai'];
        $pegawai->email_pegawai = $updateData['email'];
        $pegawai->img = $updateData['img'];

        $updateData['password'] = bcrypt($request->password_pegawai);
        $pegawai->password_pegawai = $updateData['password'];

        if($pegawai->save()){
            return response([
                'message' => 'Update Course Success',
                'data' => $pegawai
            ], 200);
        }

        return response([
            'message' => 'Update Course failed',
            'data' => null,
        ], 400);
    }
}
