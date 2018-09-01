@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Odontologo</a>
</li>
@endsection

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card card-default">
					<div class="card-header text-center">
						<h4>Lista de Odontologos</h4>
					</div>
					<div class="card-body">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th width="10px">ID</th>
									<th>Nombre</th>
									<th>Numero de Junta</th>

									@if(sizeof($users) == 0)
									<th width="237">
										@can('users.create')
										<a href="{{ route('user.create',$sub) }}" class="btn btn-block btn-success pull-right">
											Crear
										</a>
										@endcan
									</th>
									@else
									<th colspan="4" width="237">
										@can('users.create')
										<a href="{{ route('user.create',$sub) }}" class="btn btn-block btn-success pull-right">
											Crear
										</a>
										@endcan
									</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)
								<tr>
									<td>{{$user->id}}</td>
									@if($user->nombre2 == 'N/A' && $user->nombre3 == 'N/A' && $user->apellido2 == 'N/A')
									<td>{{$user->nombre1." ".$user->apellido1}}</td>
									@endif


									@if($user->nombre2 == 'N/A' && $user->nombre3 == 'N/A' && $user->apellido2 != 'N/A')
									<td>{{$user->nombre1." ".$user->apellido1." ".$user->apellido2}}</td>
									@endif


									@if($user->nombre2 != 'N/A' && $user->nombre3 == 'N/A' && $user->apellido2 == 'N/A')
									<td>{{$user->nombre1." ".$user->nombre2." ".$user->apellido1}}</td>
									@endif


									@if($user->nombre2 != 'N/A' && $user->nombre3 == 'N/A' && $user->apellido2 != 'N/A')
									<td>{{$user->nombre1." ".$user->nombre2." ".$user->apellido1." ".$user->apellido2}}</td>
									@endif


									@if($user->nombre2 != 'N/A' && $user->nombre3 != 'N/A' && $user->apellido2 == 'N/A')
									<td>{{$user->nombre1." ".$user->nombre2." ".$user->nombre3." ".$user->apellido1}}</td>
									@endif

									@if($user->nombre2 != 'N/A' && $user->nombre3 != 'N/A' && $user->apellido2 != 'N/A')
									<td>{{$user->nombre1." ".$user->nombre2." ".$user->nombre3." ".$user->apellido1." ".$user->apellido2}}</td>
									@endif
									<td>{{$user->numeroJunta}}</td>
									<td width="10px">
										@can('users.show')
											<a href="{{ route('user.show', ['user' => $user->id, 'idrol' => $sub]) }}" class="btn btn-sm btn-default bg-info" style="color: white">Ver
											</a>
										@endcan
									</td>
									<td width="10px">
										@can('users.edit')
											<a href="{{ route('user.edit', ['user' => $user->id, 'idrol' => $sub]) }}" class="btn btn-sm btn-default bg-success" style="color: white">Editar</a>
										@endcan
									</td>
									<td width="10px">
										@can('users.destroy')
											{!! Form::open(['route' => ['user.destroy', $user->id],
											'method' => 'DELETE']) !!}
												<button class="btn btn-sm btn-default bg-danger" style="color: white">
													Eliminar
												</button>
											{!! Form::close() !!}
										@endcan
									</td>
									@can('admin.revoke')
									<td width="10px">
										<a href="{{ route('user.revoke', ['user' =>$user->id, 'idrol' => $sub]) }}" class="btn btn-sm btn-default bg-warning" style="color: white">Revocar Permisos
										</a>
									</td>
									@endcan
								</tr>
								@endforeach
							</tbody>
						</table>
						{{$users->render()}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection