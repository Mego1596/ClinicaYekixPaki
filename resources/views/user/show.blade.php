@extends('layouts.base')

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
					Usuario
					</div>
					<div class="panel-body">
					<p><strong>Nombre: </strong><br>{{ $user->id }}</p>
					<p align="justify"><strong>Descripcion: </strong><br>{{ $user->name }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection