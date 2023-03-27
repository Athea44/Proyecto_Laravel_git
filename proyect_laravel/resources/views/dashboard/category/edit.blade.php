@extends('dashboard.master')
@section('contenido')
    @include('dashboard.partials.validation-error')

    <form action="{{ route("category.update",$category->id) }}" method="post">
        @method('PUT')
        @include('dashboard.category._form')
    </form>
@endsection