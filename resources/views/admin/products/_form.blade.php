
@if ($errors->any())
<div class="alert alert-danger">
    you have some errors :
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>

@endif
<div class="container">

    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        @csrf

                <!--<h2 class="mb-4 fs-3"></h2>-->
  <div class="row">

    <div class="colum-md-8">
        <div class="mb-3">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" @error('name') is-invalid @enderror name="name" placeholder="ProductName"
            value="{{old('name',$product->name)}}">
            @error('name')

            <p class="ivalid-feedback">{{$message}} </p>

            @enderror
        </div>

        <div class="mb-3">
            <label for="slug">URL Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" placeholder="URL Slug"
            value="{{old('slug',$product->slug)}}">

        </div>


        <div class="mb-3">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Description"
            value="{{old('description',$product->description)}}">

        </div>

        <div class="mb-3">
            <label for="short_description">Short Description</label>
            <input type="text" class="form-control" id="short_description" name="short_description" placeholder="Short Description"
            value="{{old('short_description',$product->short_description)}}">
        </div>
        <div class="mb-3">
            @if($product->image)
    <img src="{{asset('storage/' . $product->image)}}"  width="100" alt="">
   @else
    <img src="https://fakeimg.pl/100x100" alt="">
    @endif </a> </td>
        </div>
        <div class="mb-3">

            <input type="file" class="form-control" id="gallery" name="gallery[]" multiple placeholder="product gallery">

            <label for="image"> gallery image</label>
            @if ($gallery ?? false)
                <div class="row">
                    @foreach ($gallery as $image)
                    <div class="col-md-3">
                        <img src="/storage{{$image->url}}" class="img_fluid" alt="">
                    </div>
                    @endforeach
                </div>
                @endif
        </div>


    </div>


    <div class="colum-md-4">
        <div class="mb-3">
            <label for="status">status</label>
            @foreach ($status_options as $key => $value)
             <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status_{{$key}}" value="{{$key}}"
                @checked($key == old('status',$product->status))>
                <label class="form-check-label" for="status_{{$key}}">
                  {{$value}}
                </label>
              </div>
            @endforeach


        </div>
        <div class="mb-3">
            <label for="category">category</label>
            <select name="category_id" id="category_id" class="form-select form-control">


                @foreach ($categories as $category)
                <option @selected($category->id == old('category_id', $product->category_id)) value="{{$category->id}}">{{$category->name}}
                </option>
                @endforeach
            </select>

        </div>

                <div class="mb-3">
                    <label for="price">Product Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="price"
                    value="{{old('price',$product->price)}}"
                    step="1">

                </div>

                <div class="mb-3">
                    <label for="compare_price">compare price</label>
                    <input type="number" class="form-control" id="compare_price" name="compare_price" placeholder="compare_price"
                    value="{{old('compare_price',$product->compare_price)}}">

                </div>

                <div class="mb-3">
                    @if($product->image)
            <img src="{{asset('storage/' . $product->image)}}"  width="100" alt="">
           @else
            <img src="https://fakeimg.pl/100x100" alt="">
            @endif </a> </td>

                    <input type="file" class="form-control" id="image" name="image" placeholder="image">

                    <label for="image"> product image</label>
                </div>


    </div>
  </div>

    <button type="submit" class="btn btn-success">{{$submit_label ?? 'save'}}</button>
    </form>
</div>



{{--
                <option>cat 2</option>
                <option>cat 3</option>
                <option>cat 4</option>
                <option>cat 5</option>
                <option>cat 6</option>
                <option>cat 7</option>
                <option>cat 8</option>
                <option>cat 9</option>
                <option>cat 10</option> --}}


