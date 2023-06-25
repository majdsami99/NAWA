<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\category;
use App\Models\product;
use App\Models\ProductImages;
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
            //->where('user_id','=','2') //بدي بس المنتجات للزبون رقم واحد
            //->withoutGlobalScope('owner')  زبطت
            ///->withTrashed()عرض المحزوف وغير المحزوف من السوفت ديليت
            //->active()
            //->status('archived')
            ->paginate(5);

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
        $categories = category::all();///collection array
        return view('admin.products.create',[
            'product' => new Product(),
            'categories' => $categories ,
            /*'status_options'=> [
                'active'=>'active',
                'archived'=>'archived',
                'draft'=>'darft',]
        */
        'status_options'=> product::statusOptions()
    ]);
    }

    /**Store a newly created resource in storage*/
    public function store(ProductRequest $request)
    {
       $data=$request->validated();

       // if($request->hasFile('image')){
           // $file=$request->file('image');
          //  $file->store('upload','public');//return file path after stroe
            //disk


        //}

       // dd=($request->all());
       //
       //$product=product::create($request-> all()); //طريقة اخرى لاستدعاء القيم من خلال المودل بس لازم يكون اسم الحقل فالفورم نفسه فالداتا بيز
       if($request->hasFile('image')){
        $file =$request->file('image');
        //$file ->getMimeType();
        $path= $file ->store('uploads/images',
        ['disk'=>'public' ]);
        $data['image']=$path;

       }
       $product=product::create($data);
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

        ///$rules = $this->rules();
        //$messages = $this->messages();
       // $request->validate($rules,$messages);
        /*$product = new Product();

        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->category_id = $request->input('category_id');


        $product->description = $request->input('description');
        $product->short_description = $request->input('short_description');
        $product->price = $request->input('price');
        $product->compare_price = $request->input('compare_price');
        $product->status=$request->input('status','active');

        $product->save();*/
        if($request->hasFile('gallery')){
            foreach ( $request->file('gallery')as $file) {
              ProductImages::create([
                  'product_id'=>$product->id ,
                  'image'=>$file->store('uploads/images','public'),

              ]);
            }
            }

        return redirect()
          ->route('products.index')
          ->with('success',"product({$product->name})created");//add flash mesge
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
    public function edit($id)
    {
        $product =product::where('user_id','=','1')
        ->FindOrFail($id);
        //$product = Product::where('id' , '=',$product->id)->first(); // return model
        // $product = Product::find($product->id); // return model
        ///ولكن ممكن
        $product = Product::findOrFail($product->id); // return model
///يجب تطبيق هذه اللوكال  سكوب على كل الكنترولز ولكن مع القلوبال رح يختصر الطريق
        // if(!$product){
        //     abort(404);
        // }
        $categories = category::all();///collection array
        $gallery=ProductImages::where('product_id','=',$product->id)
        ->get();


        return view('admin.products.edit', ['product' => $product,
            'categories' => $categories ,
            'status_options'=> product::statusOptions(),
            'gallery'=>$gallery,

        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, product $product)
    {
                //$product=product::FindOrFail($id); لمنع الهكر
                //$product->update($request-> validated());
        /*$rules = [
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
            'status'=>'required|in:active,draft,archived'

        ];
        $messages = [
            'required'=>'this fieled is required',
            'unique'=>'this value already taken',
        ];
        $request->validate($rules,$messages);

        $product = Product::findOrFail($product->id); // return model

        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->category_id = $request->input('category_id');
        $product->description = $request->input('description');
        $product->short_description = $request->input('short_description');
        $product->price = $request->input('price');
        $product->compare_price = $request->input('compare_price');
        $product->status=$request->input('status','active');
        $product->save();*/

        ///from nora
        $data = $request->validated();
        if($request->hasFile('image')){
          $file =$request->file('image');//return UploadedFile object
          $path= $file ->store('uploads/images','public');//return file path after store
          $data['image'] =$path;
        }


          $old_image = $product->image;
          $product ->update($data);
          if ($old_image && $old_image != $product->image){
              Storage::disk('puplic')->delete($old_image);
          }
          if($request->hasFile('gallery')){
          foreach ( $request->file('gallery')as $file) {
            ProductImages::create([
                'product_id'=>$product->id ,
                'image'=>$file->store('uploads/images','public'),

            ]);
          }
          }


          return redirect()
          ->route('products.index')
          ->with('success',"product({$product->name})update") ;//get
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product) //فكرة المودل بايدنق
    {
        // $deleted = $product->delete();
        // return response()->json(
        //     ['message' => $deleted ? 'Deleted successfully' : 'Deleted failled '],
        //     $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        // );

        Product::destroy($product->id);
        //if ($product->image){
           // Storage::disk('puplic')->delete($product->image);}تم النقل الى الفروس ديليت
           // <img src="{{storage::disk('puplic')->delete($product->image)}}" width="60" alt="">
           //<img src="{{storage::disk('puplic')->url($product->image)}}" width="60" alt="">
        ////ليتم حذف صور المنتج عند حذف المنتج

        //$product = product::findorfail()('id');
        //$product->delete();

        return redirect()
        ->route('products.index')
        ->with('success','"product({$product->name})deleted"') ;//get

    }
    public function trashed(){
        $products=product::onlyTrashed()->paginate();
        return view ('admin.product.trashed',[
            'product'=>$products
        ]);

    }
    public function restore($id)
    {
        $product=product::onlyTrashed()->findOrFail($id);
        $product -> restore() ;
        return redirect()
        ->route('products.index')
        ->with('success',"product ({$product->name})restored");

    }
    public function forceDelete($id)
    {
        $product=product::onlyTrashed()->findOrFail($id);

        $product -> forceDelete() ;
        if ($product->image){
            Storage::disk('puplic')->delete($product->image);}
        return redirect()
        ->route('products.index')
        ->with('success',"product ({$product->name})delte forever");


    }

      /* protected function messages (){

        return[
            'required'=>'this fieled is required',
            'slug.unique'=>'this value already taken',
            'name.required' =>' the product name is mandatory',
        ];
       }
      /* protected function rules ($id =0){
        return [
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
            'status'=>'required|in:active,draft,archived'

        ];

       }تم النقل الى برودكت ريكوست في ملف الكنترولز*/

}

