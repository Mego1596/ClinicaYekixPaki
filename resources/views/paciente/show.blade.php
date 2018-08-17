@extends('layouts.base')

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
					Datos del Paciente
					</div>
					<div class="panel-body">
					<p align="justify"><strong>Nombre: </strong><br>{{ $paciente->nombre }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection