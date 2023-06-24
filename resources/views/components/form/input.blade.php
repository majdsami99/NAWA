{{--<div class="mb-3">
    <label for="name">Product Name</label>
    <div>
    <input type="text" class="form-control" id="name" @error('name') is-invalid @enderror name="name" placeholder="ProductName"
    value="{{old('name',$product->name)}}">
    @error('name')

    <p class="ivalid-feedback">{{$message}} </p>

    @enderror
</div>
</div>
