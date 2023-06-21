
@extends('layouts.admin')
@section('content')
<h2 class="mb-4 fs-3">creat NEW product</h2>

        <form action="{{route('products.store',$product->id)}}" method="post" enctype="multipart/form-data">
            @csrf

            @include('admin.products._form',[
                'submit_label'=>'create'
            ])
        </form>
@endsection


