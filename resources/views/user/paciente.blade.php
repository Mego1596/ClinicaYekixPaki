@extends('layouts.base')

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						Usuarios
						@can('users.create')
						<a href="{{ route('user.create') }}" class="btn btn-sm btn-success pull-right">
							Crear
						</a>
						@endcan
					</div>
					<div class="panel-body">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th width="10px">ID</th>
									<th>Nombre</th>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $userr)
								<tr>
									<td>{{$userr->id}}</td>
									<td>{{$userr->name}}</td>
									<td width="10px">
										@can('users.show')
											<a href="{{ route('user.show', $userr->id) }}" class="btn btn-sm btn-default bg-info" style="color: white">Ver
											</a>
										@endcan
									</td>
									<td width="10px">
										@can('users.edit')
											<a href="{{ route('user.edit', $userr->id) }}" class="btn btn-sm btn-default bg-success" style="color: white">Editar</a>
										@endcan
									</td>
									<td width="10px">
										@can('users.destroy')
											{!! Form::open(['route' => ['user.destroy', $userr->id],
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
						{{$users->render()}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection