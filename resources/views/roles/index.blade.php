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
			                	<a href="/home" class="btn btn-block btn-secondary" style="width: 130%">
			                	<i class="fa fa-arrow-circle-left"></i> Atrás</a>
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
								</tr>
							</thead>
							<tbody>
								@foreach($roles as $role)
								<tr>
									<td>{{$role->id}}</td>
									<td>{{$role->name}}</td>
									@if( $role->id <= 5)
									<td width="232" colspan="3">
										@can('roles.show')
											<a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-block btn-default bg-info" style="color: white">
			                					<i class="fa fa-folder-open-o"></i> Ver
											</a>
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