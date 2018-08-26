@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Roles</a>
</li>

@endsection

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card card-default">
					<div class="card-header text-center">
						<h4>Lista de roles</h4>
					</div>
					<div class="card-body">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th width="10px">ID</th>
									<th>Rol</th>
									@if(sizeof($roles) == 0)
									<th width="237">
										@can('roles.create')
										<a href="{{ route('roles.create') }}" class="btn btn-block btn-success pull-right">
											Crear
										</a>
										@endcan
									</th>
									@else
									<th colspan="3" width="237">
										@can('roles.create')
										<a href="{{ route('roles.create') }}" class="btn btn-block btn-success pull-right">
											Crear
										</a>
										@endcan
									</th>
									@endif
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