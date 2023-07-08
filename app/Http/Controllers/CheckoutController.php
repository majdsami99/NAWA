<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\order;
use App\Models\orderline;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;

class CheckoutController extends Controller
{
    public function create(){
        $countries = Countries::getNames('en') ;
        return view('shop.checkout',[
            'countries'=>$countries,
        ]);


    }
    public function store(Request $request){
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

       DB::beginTransaction();
try{
    $order= order::creat($validated);
foreach ($cart as $item){
    orderline::create([
        'order_id'=> $order->id,
        'product_id'=>$item->id,
        'quantity'=>$item->quantity,
        'price'=>$item->product->price,
        'product_name'=>$item->product->name


    ]);

}

///cart::where('cookie_id','=',$cookie_id)->delete();   //////////////////تم الاياقف مؤقتا لانشاء الاوردر
DB::commit();
} catch (Exception $e){
DB::rollBack();
return back()
->withInput()
->withErrors( [
    'errors',$e->getMessage()
])
->with('errors',$e->getMessage()); //flash msg

 }
  $user= User::where('type','=','super-admin')->first();
  $user->notify(new NewOrderNotification($order));

  return redirect()->route('checkout.success');

 }

  public function success(){
    return view ('shop.success');
  }


}

