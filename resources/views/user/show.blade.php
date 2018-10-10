@extends('layouts.base')

@section('bread')
@if($idRole == 'doctor')
	<li class="breadcrumb-item">
	  <a href="/user">Odontologo</a>
	</li>
@endif
@if($idRole == 'asistente')
	<li class="breadcrumb-item">
	  <a href="/asistente">Asistente</a>
	</li>
@endif
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Detalle Usuario</a>
</li>

@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header text-center">
					<div class="row">
						<div class="col-md-2 col-sm-12">
						@if($idRole == 'doctor')
							<a href="{{ route('user.index') }}" class="btn btn-block btn-secondary" style="width: 100%">
							<i class="fa fa-arrow-circle-left"></i> Atrás</a>
						@endif
						@if($idRole == 'asistente')
							<a href="{{ route('user.asistente') }}" class="btn btn-block btn-secondary" style="width: 100%">
							<i class="fa fa-arrow-circle-left"></i> Atrás</a>
						@endif
						</div>
						<div class="col-md-10">
							<h4>Datos del usuario</h4>
						</div>
					</div>
				</div>
				<div class="card-body justify-content-center">
						{!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'PUT']) !!}
						<div class="row">
							<div class="col-md-3">
								{{ Form::hidden('idRole', $idRole , ['class' => 'form-control','disabled'])}}
								<div class="form-group">
									{{ Form::label('nombre1', 'Primer Nombre') }}
									{{ Form::text('nombre1', null, ['class' => 'form-control','disabled'])}}
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									{{ Form::label('nombre2', 'Segundo Nombre') }}
									{{ Form::text('nombre2', null, ['class' => 'form-control','disabled'])}}
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									{{ Form::label('nombre3', 'Tercer nombre ', ['style' => 'display:block','id'=>'nombre3.2']) }}
									{{ Form::text('nombre3', null, ['class' => 'form-control', 'style'=>'display:block', 'id' => 'nombre3','disabled'])}}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								{{ Form::hidden('role',$idRole, ['class' => 'form-control']) }}
								<div class="form-group">
									{{ Form::label('apellido1', 'Primer apellido ') }}
									{{ Form::text('apellido1', null, ['class' => 'form-control','disabled'])}}
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									{{ Form::label('apellido2', 'Segundo apellido ') }}
									{{ Form::text('apellido2', null, ['class' => 'form-control','disabled'])}}
								</div>
							</div>
							@if($idRole=='doctor')
							<div class="col-md-3">
								<div class="form-group">
									{{ Form::label('numeroJunta', 'Numero de Junta') }}
									{{ Form::text('numeroJunta',null, ['class' => 'form-control','disabled'])}}
								</div>
							</div>
							@endif
							@if($idRole=='asistente')
								<div class="col-md-3">
									<div class="form-group">
										{{ Form::label('numeroJunta', 'Numero de Junta ', ['style' => 'display:block','id'=>'numeroJunta2']) }}
										{{ Form::text('numeroJunta', null, ['class' => 'form-control', 'style'=>'display:block', 'id' => 'numeroJunta','disabled'])}}
									</div>
								</div>
							@endif
						</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								{{ Form::label('description', 'E-Mail') }}
								{{ Form::text('email', null, ['class' => 'form-control','disabled'])}}
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								{{ Form::label('especialidad', 'Especialidad') }}
								{{ Form::text('especialidad', null, ['class' => 'form-control','disabled'])}}
							</div>
						</div>
					</div>
				</div>
						{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection