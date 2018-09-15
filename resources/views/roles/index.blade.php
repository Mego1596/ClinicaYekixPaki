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
						<div class="row">
			            	<div class="col-md-1">
			                	<a href="/home" class="btn btn-block btn-secondary">
			                	Atrás</a>
			              	</div>
			              	<div class="col-md-10">
			                	<h4>Lista de roles</h4>
			              	</div>
          				</div>
					</div>
					<div class="card-body">
						<table class="table table-striped table-hover table-responsive-md">
							<thead>
								<tr>
									<th width="10px">ID</th>
									<th width="100%">Rol</th>
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
									<td>{{$role->name}}</td>
									@if( $role->id < 5)
									<td width="232" colspan="3">
										@can('roles.show')
											<a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-block btn-default bg-info" style="color: white">Ver
											</a>
										@endcan
									</td>
									@elseif($role->id > 5)
									<td width="100%">
										@can('roles.show')
											<a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-block btn-default bg-info" style="color: white">Ver
											</a>
										@endcan
									</td>
									@elseif($role->id == 5)
									<td colspan="3">
										@can('roles.show')
											<a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-block btn-default bg-info" style="color: white">Ver
											</a>
										@endcan
									</td>
									@endif

									@if($role->id > 5 )
									<td width="10px">
										@can('roles.edit')
											<a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-default bg-success" style="color: white">Editar</a>
										@endcan
									</td>
									
									@endif

									@if($role->id > 5 )
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
									
									@endif
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