@extends('layouts.admin')

@section('content')

@include('admin.products._form',[
    'submit_label'=>'create'
])

@endsection
