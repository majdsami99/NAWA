<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller  //////بلزمنا فالسلة عرضها واضافة منتجات وحزف منتجات
{
    public function index(){

    }
    public function store(request $request){
        $request->validate()

    }
    public function destroy($id){

    }


}
