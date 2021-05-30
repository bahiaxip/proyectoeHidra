@extends('layouts.app')


@section('content')
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header back_livewire2">
						<h1 class="text-center h1">Error 403</h2>
					</div>
					<div class="card-body text-center h4">
						<p>No tiene acceso para navegar en esta página, puede volver al inicio desde el siguiente enlace</p>
						<a class="btn btn-sm back_livewire2 text-white font-weight-bold f_nav trans_logo mt-3" href="{{ url('/') }}">
                            Volver
                        </a>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection