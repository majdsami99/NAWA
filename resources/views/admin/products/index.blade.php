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
<a class="btn btn-primary m-5" href="{{route(" products.create")}}" role="button">Create Proudct</a>
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
      <td> {{$product->id}}</td>
      <td>{{$product->name}}</td>
      <td>{{$product->category_name}}</td>
      <td>{{$product->price}}</td>
      <td>{{$product->status}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>
</body>

</html> --}}
@extends('layouts.admin') <!--/////امتداد الملف الي جبنا منو التنسيق--->
@section('content')

<div class="container">
  <h2 class="mb-4 fs-3">
    <?= $title ?>
  </h2>
  <header class="mb-4">
  <a class="btn btn-primary m-3" href="{{route("products.create")}}" role="button">Create Proudct</a>
  <a href="{{route("products.trashed")}}"class="btn btn-danger m-3"  role="button"><i class="fas fa-trash"></i>trashed</a>

  </header>
  @if(session()->has('success'))
  <div class ="alert alert-success"> <!--الرسالة بطبعها من خلال السيشن لانها تخزنت فيها -->
    {{ session('success')}}
  </div>
  @endif
    {{--فلترة {{url::current}}===route('products.index')--}}
  <form action ="{{URL::current()}}" method="get" class= "form-inline">
    <input type ="text" name="search" value="{{ request('search')}}" class="form-control mb-2 mr-2" placeholder="Search">
    <select name ="status" class="form-control mb-2 mr-2">
        <option value="">status</option>
        <option value="active" @selected(request('status')== 'active')>active</option>
        <option value="archived" @selected(request('status')== 'archived')>archived</option>
        <option value="draft" @selected(request('status')== 'draft')>draft</option>
    </select>

    <input type="number" name="price_min" aria-placeholder="min price" class="form-control mb-2 mr-2"  value="{{request('search')}}" >
    <input type="number" name="price_max" aria-placeholder="max price" class="form-control mb-2 mr-2"  value="{{request('search')}}" >
    <button type="submit" aria-placeholder="Search" class="form-control mb-2 mr-2 btn btn-dark"  value="{{request('search')}}">filtter</button>

    {{--<input type="submit" name="price_min" aria-placeholder="Search" class="form_control btn btn-dark"  value="{{request('search')}}"  >filtter</button>
    <input type="submit" name="price_min" aria-placeholder="Search" class="form_control btn btn-dark"  value="{{request('search')}}"  >filtter</button> --}}

  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th>Id</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ( $products as $product )
      <tr><td>
            <a href="{{asset('storage/' . $product->image)}}">
            {{--<img src="{{asset('storage/' . $product->imagel)}}"  width="60" alt="">--}}
            @if($product->image)
            <img src="{{asset('storage/' . $product->image)}}"  width="60" alt="">
           @else
            <img src="https://fakeimg.pl/60x60" alt="">
            @endif </a> </td>
        <td>{{$product->id}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->category_name}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->status}}</td>
        <td><a href="{{route('products.edit' ,$product->id)}}" class="btn btn-sm btn-outline-dark"><i class="far fa-edit"></i> Edit</a></td>
        <td> <form action="{{route('products.destroy',$product->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"> delete</i></button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
{{$products->links()}}

@endsection
