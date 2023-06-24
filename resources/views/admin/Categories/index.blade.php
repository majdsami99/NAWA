{{--
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h2 class="mb-4 fs-3">
      {{$title}}
    </h2>
    <a class="btn btn-primary m-5" href="{{route('products.create')}}" role="button">Create Proudct</a>
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Category</th>
          <th>Price</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ( $products as $product )
        <tr>
          <td>{{$product->id}}</td>
          <td>{{$product->name}}</td>
          <td>{{$product->category_name}}</td>
          <td>{{$product->price}}</td>
          <td>{{$product->status}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
</body>
/////كيف ممكن اربط الاي دي مع ترتيب الكاتوقوري

</html> --}}

@extends('layouts.admin')
@section('content')
<div class="container">
  <h2 class="mb-4 fs-3">
    <?= $title ?>
  </h2>
  <a class="btn btn-primary m-5" href="{{route("categories.create")}}" role="button">Create category</a>
  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th>Id</th>
        <th>Name</th>
        <th>Edit</th>
        <th>Delete</th>

      </tr>
    </thead>
    <tbody>
      @foreach ( $categories as $category )
      <tr>

        <td> <a href="{{asset('storage/' . $category->image)}}">
            {{--<img src="{{asset('storage/' . $product->imagel)}}"  width="60" alt="">--}}
            @if($category->image)
            <img src="{{asset('storage/' . $category->image)}}"  width="60" alt="">
           @else
            <img src="https://fakeimg.pl/60x60" alt="">
            @endif </a> </td></td>
    </td>
        <td>{{$category->id}}</td>

        <td>{{$category->name}}</td>

        <td><a href="{{route('categories.edit' ,$category->id)}}" class="btn btn-sm btn-outline-dark"><i
              class="far fa-edit"></i> Edit</a></td>
        <td><form action="{{route('categories.destroy',$category->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"> delete</i></button>
          </form>


      </tr>
      @endforeach
    </tbody>
  </table>
</div>


@endsection
