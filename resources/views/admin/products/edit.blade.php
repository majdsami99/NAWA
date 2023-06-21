@extends('layouts.admin')
@section('content')
<h2 class="mb-4 fs-3">Edit product</h2>

        <form action="{{route('products.update',$product->id)}}" method="post"enctype="multipart/form-data">
            @csrf
            {{--comment form ,ethod spofing--}}
            <input type="hidden" name="_method" value="put">
            @method('PUT')
            @include('admin.products._form',[
                'submit_label'=>'updated'
            ])

        </form>
@endsection


