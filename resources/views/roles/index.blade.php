@extends('layouts.base')

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						Roles
						@can('roles.create')
						<a href="{{ route('roles.create') }}" class="btn btn-sm btn-success pull-right">
							Crear
						</a>
						@endcan
					</div>
					<div class="panel-body">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th width="10px">ID</th>
									<th>Rol</th>
								</tr>
							</thead>
							<tbody>
								@foreach($roles as $role)
								<tr>
									<td>{{$role->id}}</td>
									<td>{{$role->slug}}</td>
									<td width="10px">
										@can('roles.show')
											<a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-default bg-info" style="color: white">Ver
											</a>
										@endcan
									</td>
									<td width="10px">
										@can('roles.edit')
											<a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-default bg-success" style="color: white">Editar</a>
										@endcan
									</td>
									<td width="10px">
										@can('roles.destroy')
											{!! Form::open(['route' => ['roles.destroy', $role->id],
											'method' => 'DELETE']) !!}
												<button class="btn btn-sm btn-default bg-danger" style="color: white">
													Eliminar
												</button>
											{!! Form::close() !!}
										@endcan
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{{$roles->render()}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection