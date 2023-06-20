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
        <h2 class="mb-4 fs-3">New product</h2>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" @error('name') is-invalid @enderror name="name" placeholder="ProductName">
            <label for="name">Product Name</label>
            @error('name')
            <p class="ivalid-feedback">{{$message}} </p>

            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="slug" name="slug" placeholder="URL Slug">
            <label for="slug">URL Slug</label>
        </div>
        <div class="form-floating mb-3">
            <label for="category">category</label>
            <select name="category_id" id="">
                @foreach ($categories as $category)
                <option @selected($category->id == $product->category_id) value="{{$category->id}}">{{$category->name}}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="description" name="description" placeholder="Description">
            <label for="description">Description</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="short_description" name="short_description" placeholder="Short Description">
            <label for="short_description">Short Description</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="price" name="price" placeholder="price">
            <label for="price">Product Price</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="compare_price" name="compare_price" placeholder="compare_price">
            <label for="compare_price">compare price</label>
        </div>

        <div class="form-floating mb-3">
            <input type="file" class="form-control" id="image" name="image" placeholder="image">
            <label for="image">image</label>
        </div>

        <button type="submit" class="btn btn-success">Success</button>

    </form>
</div>