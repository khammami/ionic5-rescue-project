<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Categories::all();
        if(!$categories){
            $response=[
                'status'=>'echec'
            ];
        }
        else{
            $response=[
                'status'=>'succes',
                'categories'=>$categories
            ];
        }
        return $response;
    }

    public function store(Request $request){
        $categorie=Categories::create([
            'name'=>$request['name'],
            'image'=>$request['image']
    ]);
    if(!$categorie){
        $response=[
            'status'=>'echec'
        ];
    }
    else{
        $response=[
            'status'=>'succes'
        ];
    }

    return response($response);
    }
}
