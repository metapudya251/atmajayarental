<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Aset;

class AsetController extends Controller
{
    public function index(){
        $asets = Aset::where('status_kontrak', 'not like', '-' . '%')
                    ->orWhere('status_kontrak', '=', '0 days remaining' )->get();

        if(count($asets) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $asets
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id){
        $asets= Aset::find($id);

        if(!is_null($asets)){
            return response([
                'message' => 'Retrieve Course Success',
                'data' => $asets
            ], 200);
        }

        return response([
            'message' => 'Course Not Found',
            'data' => null
        ], 404);
    }

    public function destroy($id){
        $asets = Aset::find($id);

        if(is_null($asets)){
            return response([
                'message' => 'Course Not Found',
                'data' => null
            ], 404);
        }

        if($asets->delete()){
            return response([
                'message' => 'Delete course Success',
                'data' =>$asets
            ],200);
        }

        return response([
            'message' => 'Delete Course Success',
            'data' =>null,
        ], 400);

    }
}
