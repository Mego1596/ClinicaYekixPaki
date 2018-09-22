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
				<div class="card card-default">
					<div class="card-header text-center">
					<div class="row">
							<div class="col-md-1">
								<a href="{{ route('roles.index') }}" class="btn btn-block btn-secondary" style="width: 130%">
			                	<i class="fa fa-arrow-circle-left"></i> Atrás</a>
							</div>
							<div class="col-md-10">
								<h4>Rol</h4>
							</div>
						</div>
					</div>
					<div class="card-body">
						<p><strong>Nombre: </strong><br>{{ $role->name }}</p>
						<p align="justify"><strong>Descripcion: </strong><br>{{ $role->description }}</p>
						<table style="margin-left:10px ">
						@if(sizeof($permisos) == 0)
							@if($role->id == 1)
								<tr>
									<td>
									<li>Acceso Total</li>
									</td>
								</tr>
							@elseif($role->id == 4)
								<tr>
									<td>
										<li>Ningun Acceso</li>
									</td>
								</tr>
							@else
							@endif
						@else
							@foreach($permisos as $permiso)
								<tr>
									<td>
										<li>{{$permiso->name}}</li>
									</td>
								</tr>	
							@endforeach
						@endif
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection