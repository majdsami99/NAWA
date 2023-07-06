<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\order;
use App\Models\orderline;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function creat(){
        return view('shop.checkout');

    }
    public function stroe(Request $request){
        $validated = $request->validate([
        'custmer_first_name'=>'required',
        'custmer_last_name'=>'required',
        'custmer_email'=>'nullable',
       'custmer_phone'=>'required',
       'custmer_addres'=>'required',
        'custmer_city'=>'required',
        'custmer_postal_code'=>'nullable',
        'custmer_province'=>'nullable',
       'custmer_country_code'=>'required|string|size:2',

        ]);
        $validated['user_id']= Auth::id();
        $validated['status']='pending';
        $validated['payment_status']='pending';
        $validated['currency']='EUR' ;

        $cookie_id=$request->cookie('cart_id');
        $cart=cart::with('product')->where('cookie_id','=',$cookie_id) ->get(); ///collection
        $total=$cart->sum(function($item){
            return $item->product->price_formatted * $item->quantity;

        });
        $validated['total']= $total;
       $order= order::creat($validated);
       DB::beginTransaction();
try{
@foreach ($cart as $item){
    orderline::create([
        'order_id'=> $order->id,
        'product_id'=>$item->product_id,
        'quantity'=>$item->quantity,
        'price'=>$item->product->price,
        'product_name'=>$item->product->name


    ]);
}
cart::where('cookie_id','=',$cookie_id)->delete();
DB::commit();
} catch (Exception $e){
DB::rollBack();
return back()
->withInput()
->withErrors( [
    'errors',$e->getMessage()
])
->with('errors',$e->getMessage());

 }
  return redirect()->route('checkout.success');
 }}

