<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\ProductImage;
use App\Models\ProductImages;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function index(){
        $products = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
        ->select([
            'products.*',
            'categories.name as category_name'
        ])
        ->when($request->search,function($query,$value){

           $query->where(function($query)use ($value){
            $query->where('products.name','like',"%{$value}%")
           ->orwhere('products.name','like',"%{$value}%");
           });
        })
        ->when($request->status,function($query,$value){
            $query->where('products.status','=',$value);
        })
        ->when($request->price_min,function($query,$value){
            $query->where('products.price','>=',$value);
        })
        ->when($request->price_max,function($query,$value){
            $query->where('products.price','<=',$value);
        });
        //->paginate(10);

    return view('admin.products.index', [
        'title' => 'Products List',
        'products' => $products,
    ]);
}
    }

    public function show($slug){

        $product= product::active()
        ->withoutGlobalScope('owner')
        ->where('slug','=',$slug)
        ->firstorfail();
        $gallery=ProductImages::where('product_id','=',$product->id)
        ->get();

        return view ('shop.products.show',[
            'product'=> $product,
            'gallery'=>$gallery,
        ]);

    }
}
