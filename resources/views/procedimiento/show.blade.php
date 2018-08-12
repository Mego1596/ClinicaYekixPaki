@extends('layouts.base')

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
					Procedimiento
					</div>
					<div class="panel-body">
					<p><strong>Nombre: </strong><br>{{ $procedimiento->nombre }}</p>
					<p align="justify"><strong>Descripcion: </strong><br>{{ $procedimiento->descripcion }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection