@extends('layouts.base')
@section('bread')
	<li class="breadcrumb-item">
  		<a href="/events">Citas</a>
	</li>
	<li class="breadcrumb-item">
  		<a href="{{route('planTratamiento.index', ['cita'=> $id, 'validador' =>$validador])}}">Plan de Tratamiento</a>
	</li>
	<li class="breadcrumb-item">
  		<a class="breadcrumb-item active">Asignar Procedimiento</a>
	</li>
@endsection

@section('content')
<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card card-default">
					<div class="card-header text-center">
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<a href="{{ route('planTratamiento.index',['cita'=> $id, 'validador' => $validador]) }}" class="btn btn-block btn-secondary" style="width: 100%">
								<li class="fa fa-arrow-circle-left"></li>Atrás</a>
							</div>
							<div class="col-md-10">
								<h4>Asignar Procedimiento</h4>
							</div>
						</div>
					</div>
					<div class="card-body">
						{!! Form::open(['route' => 'planTratamiento.store', 'autocomplete'=> 'off']) !!}

							@include('planTratamiento.partials.form')
							{!! Form::hidden('validador', $validador, ['class' => 'form-control'])!!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
</div>
@endsection