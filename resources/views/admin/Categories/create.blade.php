
@extends('layouts.admin')
@section('content')
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
    <form action="{{route('categories.store')}}" method="post"  enctype="multipart/form-data">
      @csrf
      <h2 class="mb-4 fs-3">New Category</h2>
      <div class="form-floating mb-3">
        <label for="name">Category Name</label>
        <input type="text"  required class="form-control" id="name" name="name" placeholder="categoryName">
        @error('name')
        <p class="text-danger">{{$message}} </p>

        @enderror
      </div>
      {{--<div class="mb-3">
        <label for="status">status</label>
        @foreach ($status_options as $key => $value)
         <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="status_{{$key}}" value="{{$key}}"
            @checked($key == old('status',$category->status))>
            <label class="form-check-label" for="status_{{$key}}">
              {{$value}}
              @endforeach
            </label>
          </div>
    </div> --}}
          <div class="colum-md-4">

          <div class="form-floating mb-3">

            <input type="file" cla ss="form-control" id="image" name="image" placeholder="Compare category Image">
            <label for="image">category Image</label>
            {{--<img src="{{$category->image_url}}"  width="60" alt=""> --}}
            @if($category->image)
            <img src="{{asset('storage/' .  $category->image)}}"  width="100" alt="">
           @else
            <img src="https://fakeimg.pl/100x100" alt="">
            @endif

        </div></div>

      <button type="submit" class="btn btn-success">Success</button>
    </form>

  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
</body>

@endsection
