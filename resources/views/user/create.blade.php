@extends('layouts.base')

@section('bread')
@if($idRole == 'Dentista')
	<li class="breadcrumb-item">
	  <a href="/user">Dentista</a>
	</li>
@endif
@if($idRole == 'Asistente')
	<li class="breadcrumb-item">
	  <a href="/asistente">Asistente</a>
	</li>
@endif
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Crear Usuario</a>
</li>

@endsection

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
					Usuario
					</div>
					<div class="panel-body">
						{!! Form::open(['route' => 'user.store']) !!}

							@include('user.partials.form')

						{!! Form::close() !!}

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection