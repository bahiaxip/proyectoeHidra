@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header back_livewire2">
                    ¡Enhorabuena {{ Auth::user()->name }}!
                </div>
                <div class="card-body">
                    Ha confirmado su autenticación con su correo correctamente
                </div>
            </div>
        </div>
    </div>
</div>
@endsection