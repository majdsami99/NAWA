
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
    <form action="{{route('categories.store')}}" method="post">
      @csrf
      <h2 class="mb-4 fs-3">New Category</h2>
      <div class="form-floating mb-3">
        <label for="name">Category Name</label>
        <input type="text"  required class="form-control" id="name" name="name" placeholder="categoryName">
        @error('name')
        <p class="text-danger">{{$message}} </p>

        @enderror
      </div>

      <button type="submit" class="btn btn-success">Success</button>
    </form>

  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
</body>

@endsection
