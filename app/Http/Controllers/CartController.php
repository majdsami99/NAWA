<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use illminate\Support\Str;

class CartController extends Controller  //////بلزمنا فالسلة عرضها واضافة منتجات وحزف منتجات
{
    public function index( request $request){
        $cookie_id=$request->cookie('cart_id');
        $cart=cart::where('cookie_id','=',$cookie_id) ->get ; ///collection
        $total=$cart->sum(function($item)){
            return $item->product->
        }


    }
    public function store(request $request){
        $request->validate([
            'product_id'=>['erquired'.'int','exists:products,id'],
            'quantity' =>['nullable','int','min:1','max:99'],
        ]);
        $cookie_id=$request->cookie('cart_id');
        if(!$cookie_id){
            $cookie_id=STR::uuid();
            Cookie::queue('cart_id',60*24*30);

        }
        $item= cart::where('$cookie_id','=',$cookie_id)
        ->where('product_id','=',$request->input(('product_id')))
        ->first();
        if($item){
            $item->increment('quantity',$request->input('quantity',1));
        }
        else{

        cart::create([
            'cookie_id'=>$cookie_id,
            'user_id'=> Auth::id(),
            'product_id'=>$request->input('product_id'),
            'quantity'=> $request->input('quantity',1)


        ]);
        return back()->with('success','product');

    }}
    public function destroy($id){

    }


}
