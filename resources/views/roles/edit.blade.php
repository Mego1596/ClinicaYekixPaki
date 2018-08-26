@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a href="/roles">Roles</a>
</li>

<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Editar Rol</a>
</li>

@endsection

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
					Role
					</div>
					<div class="panel-body">
						{!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT']) !!}

							@include('roles.partials.form')

						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection