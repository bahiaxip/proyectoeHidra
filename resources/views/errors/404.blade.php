@extends('layouts.app')


@section('content')
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header back_livewire2">
						<h1 class="text-center h1">Error 404</h2>
					</div>
					<div class="card-body text-center h4">
						<p>Ha llegado a una página que no existe, puede volver al inicio desde el siguiente enlace</p>

						<a class="btn btn-sm back_livewire2 text-white font-weight-bold f_nav trans_logo mt-3" href="{{ url('/') }}">
                            Volver
                        </a>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection