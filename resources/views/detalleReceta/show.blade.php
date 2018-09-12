@extends('layouts.base')


@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card card-default">
					<div class="card-header text-center">
						<div class="row">
							<div class="col-md-1">
								<a href="{{ route('detalleReceta.index', $detalles->id) }}" class="btn btn-block btn-secondary">
								Atrás</a>
							</div>
							<div class="col-md-10">
								<h4>Datos del paciente</h4>
							</div>
						</div>
					</div>
					<div class="card-body">
						{!! Form::model($detalles, ['route' => ['detalleReceta.update', $detalles->id]]) !!}
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									{{ Form::label('medicamento', 'Medicamento*') }}
									{{ Form::text('medicamento', null,['class' => 'form-control', 'disabled']) }}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									{{ Form::label('dosis', 'Dosis*') }}
									{{ Form::text('dosis', null, ['class' => 'form-control', 'disabled'])}}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									{{ Form::label('cantidad', 'Cantidad*') }}
									{{ Form::text('cantidad', null, ['class' => 'form-control', 'disabled'])}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection