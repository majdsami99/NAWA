<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <form action="{{route('categories.update',$category->id)}}" method="post"  enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h2 class="mb-4 fs-3">EDIT Category</h2>
            {{--<div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="categoryName"
                value="{{$category->name}}">
                <label for="name">Category Name</label>
              </div>--}}
              <div class="row">

                <div class="colum-md-8">
                <div class="mb-3">
                    <label for="name">category Name</label>
                    <input type="text" class="form-control" id="name" @error('name') is-invalid @enderror name="name" placeholder="ProductName"
                    value="{{old('name',$category->name)}}">
                    @error('name')

                    <p class="ivalid-feedback">{{$message}} </p>

                    @enderror
                </div>
                <div class="mb-3">
                    {{--<label for="status">status</label>
                    @foreach ($status_options as $key => $value)
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status_{{$key}}" value="{{$key}}"
                        @checked($key == old('status',$category->status))>
                        <label class="form-check-label" for="status_{{$key}}">
                          {{$value}}
                          @endforeach
                        </label>
                      </div>
                </div>--}}
                      <div class="colum-md-4">

                      <div class="form-floating mb-3">

                        <input type="file" class="form-control" id="image" name="image" placeholder="Compare category Image">
                        <label for="image">category Image</label>
                       {{--<img src="{{$category->image_url}}"  width="60" alt="">--}}
                        @if( $category->image)
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

</html>
