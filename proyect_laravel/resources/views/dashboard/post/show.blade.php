@extends('dashboard.master')
@section('contenido')
    @include('dashboard.partials.validation-error')

    <form action="{{ route('post.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="form-group">
                <label for="name">Articulo</label><input readonly class="form-control" type="text" name="name"
                    id="name" value="{{ $post->name }}">
            </div>
        </div>

        <div class="form-group">
            <label for="url_clean">Url limpia</label>
            <input readonly class="form-control" type="text" name="url_clean" id="url_clean" value="{{ $post->url_clean}}">         </div>

        <div class="row form-group">
            <label for="description">Contenido</label>
            <textarea readonly class="form-control" name="description" id="description" rows="10" rows="10"> {{ $post->description }}</textarea>
        </div>

    </form>
@endsection
