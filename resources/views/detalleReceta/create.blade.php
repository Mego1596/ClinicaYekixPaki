@extends('layouts.base')
@section('bread')
<li class="breadcrumb-item">
  <a href="/events">Citas</a>
</li>
<li class="breadcrumb-item">
  <a href="{{route('receta.index', $id2)}}">Recetas</a>
</li>
<li class="breadcrumb-item">
  <a href="{{route('detalleReceta.index', ['cita' => $id2, 'receta' => $id])}}">Detalle Receta</a>
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
								<a href="{{route('detalleReceta.index', ['cita' => $id2, 'receta' => $id])}}" class="btn btn-block btn-secondary">
								Atrás</a>
							</div>
							<div class="col-md-10">
								<h4>Crear Detalle de Receta</h4>
							</div>
						</div>
					</div>
					<div class="card-body">
						{!! Form::open(['route' => 'detalleReceta.store', 'autocomplete'=> 'off']) !!}
						{!! Form::hidden('cita', $id2 ,['class' => 'form-control']) !!}
							@include('detalleReceta.partials.form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection