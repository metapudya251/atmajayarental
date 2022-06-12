<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Promo;

class PromoController extends Controller
{
    public function index(){
        $promos = Promo::all();

        if(count($promos) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $promos
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id){
        $promos= Promo::find($id);

        if(!is_null($promos)){
            return response([
                'message' => 'Retrieve Course Success',
                'data' => $promos
            ], 200);
        }

        return response([
            'message' => 'Course Not Found',
            'data' => null
        ], 404);
    }
    public function showAktif(){
        $promos= Promo::where('status_promo', 'like', 'Aktif' . '%');

        if(!is_null($promos)){
            return response([
                'message' => 'Retrieve Course Success',
                'data' => $promos->get()
            ], 200);
        }

        return response([
            'message' => 'Course Not Found',
            'data' => null
        ], 404);
    }

    public function destroy($id){
        $promos = Promo::find($id);

        if(is_null($promos)){
            return response([
                'message' => 'Course Not Found',
                'data' => null
            ], 404);
        }

        if($promos->delete()){
            return response([
                'message' => 'Delete course Success',
                'data' =>$promos
            ],200);
        }

        return response([
            'message' => 'Delete Course Success',
            'data' =>null,
        ], 400);

    }

}
