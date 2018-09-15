@extends('layouts.base')
@section('bread')
<li class="breadcrumb-item">
  <a href="/events">Citas</a>
</li>
<li class="breadcrumb-item">
  <a href="{{route('receta.index', $id3)}}">Recetas</a>
</li>
<li class="breadcrumb-item">
  <a href="{{route('detalleReceta.index', ['cita' => $id3, 'receta' => $id2])}}">Detalle Receta</a>
</li>
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Crear Detalle Receta</a>
</li>
@endsection

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card card-default">
					<div class="card-header text-center">
						<div class="row">
							<div class="col-md-1">
								<a href="{{route('detalleReceta.index', ['cita' => $id3, 'receta' => $id2])}}" class="btn btn-block btn-secondary">
								Atrás</a>
							</div>
							<div class="col-md-10">
								<h4>Detalle de Receta</h4>
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