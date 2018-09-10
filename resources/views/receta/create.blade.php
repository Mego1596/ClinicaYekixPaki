@extends('layouts.base')
@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card card-default">
					<div class="card-header text-center">
						<div class="row">
							<div class="col-md-1">
								<a href="{{ route('receta.index',['cita' => $id ]) }}" class="btn btn-block btn-secondary">
								Atrás</a>
							</div>
							<div class="col-md-10">
								<h4>Crear Receta</h4>
							</div>
						</div>
					</div>
					<div class="card-body">
						{!! Form::open(['route' => 'receta.store']) !!}

							@include('receta.partials.form')

						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection