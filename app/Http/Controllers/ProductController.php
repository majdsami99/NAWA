<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->select([
                'products.*',
                'categories.name as category_name'
            ])
            ->get();

        return view('admin.products.index', [
            'title' => 'Products List',
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = category::all();
        return view('admin.products.create',[
            'product' => new Product(),
            'categories' => $categories ,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // $data=$request->validated();
       // if($request->hasFile('image')){
           // $file=$request->file('image');
          //  $file->store('upload','public');//return file path after stroe
            //disk


        //}
       // $product=product::create($data);
        
         // $request ->input('slug');
        /*$rules=[
            'name'=>'required|max:225|min:3',
            'slug'=>"required|unique:product,slug,$id",///لحل مشكلة الابديت على نفس العنصر بسبب السلق انو هوبالفعل موجود
            'category_id'=>'nullable|int|exist:categories,id',
            'description'=>'nullable|string',
            'short_description'=>'nullable|strin|max:500',
            'price'=>'required|numric|min:0', //numric اي نوع من الاعداد
            'compare_price'=>'nullable|numric|min:0|gt:ptice',//gt (greater than)gte)(greater and equal)
            'image'=>'nullable|iamge|dimentions:min_width=400,min_hight=300|max:1024',//(لدقة اعلى)
            //(1024= 1mega)
            //'image'=>'iamge|dimentions:width=100,high=200'
            //'image'=>'file|mimes:png,jbg'
            //'image'=>'file|mimetypes:image.png,image.jbg' (more save than mimes)*/

        $rules = [
            'name'=>'required|max:255|min:3',
            'slug'=> 'required|unique:products,slug',
            'category_id'=> 'nullable|int|exists:categories,id',
            'descripton'=> 'nullable|string',
            'short_description'=> 'nullable|string|max:500',
            'price'=>'required|numeric|min:0',
            'compare_price'=> 'nullable|numeric|min:0,gt:price',
            // 'image'=>'file:=|mimetypes:image/png,image/jpg',
            // 'image'=>'file|mimes:png,jpg',
            'image'=> 'nullable|image|dimensions:min_width=400,min_height=300|max:400',//kilobayte

        ];
        $request->validate($rules);
        $product = new Product();

        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->description = $request->input('description');
        $product->short_description = $request->input('short_description');
        $product->price = $request->input('price');
        $product->compare_price = $request->input('compare_price');

        $product->save();

        return redirect()
        ->route('products.index')
        ->with('success',"Product $product->name Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //$product = Product::where('id' , '=',$product->id)->first(); // return model
        // $product = Product::find($product->id); // return model
        $product = Product::findOrFail($product->id); // return model

        // if(!$product){
        //     abort(404);
        // }
        return view('admin.products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, product $product)
    {
        ///from nora 
        $data = $request->validated();
        if($request->hasFile('image')){
          $file =$request->file('image');//return UploadedFile object
          $path= $file ->store('uploaads/images','public');//return file path after store
          $data['image'] =$path;
        }
          $old_image = $product->image;
          $product ->update($data);
          if ($old_image&&$old_image != $product->image){
              Storage::disk('puplic')->delete($old_image);
          }
       /* $product = Product::findOrFail($product->id); // return model

        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->description = $request->input('description');
        $product->short_description = $request->input('short_description');
        $product->price = $request->input('price');
        $product->compare_price = $request->input('compare_price');

        $product->save();

        return redirect()->route('products.index');*/
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        // $deleted = $product->delete();
        // return response()->json(
        //     ['message' => $deleted ? 'Deleted successfully' : 'Deleted failled '],
        //     $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        // );

        Product::destroy($product->id);
        return redirect()->route('products.index');

    }
}
