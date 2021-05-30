@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">{{ __('Autenticar su correo electrónico') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un nuevo enlace de autenticación ha sido enviado a su correo electrónico.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, revise el enlace de autenticación en su email.') }}
                    {{ __('Si no lo ha recibido') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('pulse aquí para enviar de nuevo') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
