@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @auth
                        Re Bienvenido al  Proyect.Laravel {{ auth()-> user()->name }}
                    @endauth

                    
                    {{ __('Tu estas logueado!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
