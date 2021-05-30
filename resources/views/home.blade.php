@extends('layouts.app')

@section('content')
<div class="w-100 ">
    <div class="row justify-content-center">
        <div class="col-auto h3 text-center nav_livewire2 p-4 rounded text-white">
            Proyecto de prueba de eHidra con Laravel 8
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @guest
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card-text text-center h5">
                    {{ __('Es necesario iniciar sesión para acceder al contenido') }}
                </div>
            @else
                <div class="card-text text-center h5">
                    {{ __('La sesión ha sido iniciada correctamente') }}
                </div>
            @endguest
        </div>
    </div>
</div>
@endsection
