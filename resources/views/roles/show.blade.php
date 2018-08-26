@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a href="/roles">Roles</a>
</li>

<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Detalle Rol</a>
</li>

@endsection

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
					Rol
					</div>
					<div class="panel-body">
					<p><strong>Nombre: </strong><br>{{ $role->name }}</p>
					<p><strong>Slug: </strong><br>{{ $role->slug }}</p>
					<p align="justify"><strong>Descripcion: </strong><br>{{ $role->description }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection