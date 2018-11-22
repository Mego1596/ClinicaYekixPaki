@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Asistente</a>
</li>
@endsection


@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card card-default">
					<div class="card-header text-center">
						<div class="row">
			            	<div class="col-md-2 col-sm-12">
			                	<a href="/home" class="btn btn-block btn-secondary" style="width: 100%">
			                	<i class="fa fa-arrow-circle-left"></i> Atrás</a>
			              	</div>
			              	<div class="col-md-8">
								<h4>{{$head}}</h4>
			              	</div>
          				</div>
					</div>
					<br/>
					@role('admin')
					<div class="row"> 
						<div class="col-md-2 col-sm-12" style="margin-left: 2%">
						    {!! Form::open(array('route' => 'user.search2','id'=> 'form', 'method' => 'POST', 'autocomplete'=>'off') ) !!}
						    	<div>
									<select class="form-control" name="buscador" id="buscador">
										<option id="0">Buscar Por...</option>
										<option id="1">Nombre</option>
										<option id="2">Apellido</option>
										<option id="4" selected>Nombre de Usuario</option>
									</select>
								</div>
						</div>
						<br />
						<div class="col-md-4 col-sm-12" style="margin-left: 2%">
						        <div class="input-group">
						          <input type="text" class="form-control" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2" id="buscar" name="buscar">
						          <div class="input-group-append">
						            <button class="btn btn-primary" type="submit">
						              <i class="fa fa-search"></i>
						            </button>
						          </div>
						        </div>
						</div>
						<br />
						<div class="col-md-4 col-sm-12" style="margin-left: 2%">
							<a class="btn btn-primary" href="{{route('user.asistente')}}"><i class="fa fa-list"></i> Ver Lista Completa</a>
						</div>
						    {!! Form::close() !!}
					</div>
					@endrole
					<div class="card-body">
						<table class="table table-striped table-hover table-responsive-md">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Nombre de Usuario</th>
									@if(sizeof($users) == 0)
									<th width="237">
										@can('users.create')
										<a href="{{ route('user.create',$sub) }}" class="btn btn-block btn-success pull-right">
										<i class="fa fa-user-plus"></i>	Crear Asistente
										</a>
										@endcan
									</th>
									@else
									<th colspan="4" width="237">
										@can('users.create')
										<a href="{{ route('user.create',$sub) }}" class="btn btn-block btn-success pull-right">
										<i class="fa fa-user-plus"></i>	Crear Asistente
										</a>
										@endcan
									</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)
								<tr>
									<td>{{$user->nombre1." ".$user->nombre2." ".$user->nombre3." ".$user->apellido1." ".$user->apellido2}}</td>
									<td>
										{{$user->name}}
									</td>
									<td width="10px">
										@can('users.show')
											<a href="{{ route('user.show', ['user' => $user->id, 'idrol' => $sub]) }}" class="btn btn-sm btn-default bg-info" style="color: white"><i class="fa fa-folder-open-o"></i> Ver
											</a>
										@endcan
									</td>
									<td width="10px">
										@can('users.edit')
											<a href="{{ route('user.edit', ['user' => $user->id, 'idrol' => $sub]) }}" class="btn btn-sm btn-default bg-success" style="color: white"><i class="fa fa-edit"></i> Editar</a>
										@endcan
									</td>
									<td width="10px">
										@can('users.destroy')
										<button type="button" class="btn btn-sm btn-default btn btn-danger" data-toggle="modal" data-target="#Modal{{$user->id}}"><i class="fa fa-trash"></i> 
						  					Eliminar
										</button>
										{!! Form::open(['route' => ['user.destroy', $user->id,"asistente"],'method' => 'DELETE']) !!}
											<!-- Modal -->
											<div class="modal fade" id="Modal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
											    	<div class="modal-content">
											    		<div class="modal-header">
											        		<h5 class="modal-title" id="exampleModalLabel"> Eliminar Asistente</h5>
											        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          				<span aria-hidden="true">&times;</span>
											        			</button>
											      		</div>
											      		<div class="modal-body">
											      			<label>Estas seguro?</label>
											      			<br/>
											      			<button type="button" class="btn btn-md btn-default" data-dismiss="modal">No</button>
											        		<button class="btn btn-md btn-default bg-danger" style="color: white">
																Si
															</button>
											      		</div>
											      		<div class="modal-footer">
											      		</div>
											    	</div>
												</div>
											</div>
											{!! Form::close() !!}

										@endcan
									</td>
									@can('admin.revoke')
									<td width="100px">
										<button type="button" class="btn btn-sm btn-default btn btn-warning" data-toggle="modal" data-target="#Modal2{{$user->id}}">
						  				<i class="fa fa-minus-square" style="color: white"></i> 	Remover Permisos
										</button>
										{!! Form::open(['route' => ['user.revoke', $user->id, $sub],'method' => 'GET']) !!}
											<!-- Modal -->
											<div class="modal fade" id="Modal2{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog" role="document">
											    	<div class="modal-content">
											    		<div class="modal-header">
											        		<h5 class="modal-title" id="exampleModalLabel"> Remover Permisos</h5>
											        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          				<span aria-hidden="true">&times;</span>
											        			</button>
											      		</div>
											      		<div class="modal-body">
											      			<label>Estas seguro?</label>
											      			<br/>
											      			<button type="button" class="btn btn-md btn-default" data-dismiss="modal">No</button>
											        		<button class="btn btn-md btn-default bg-danger" style="color: white">
																Si
															</button>
											      		</div>
											      		<div class="modal-footer">
											      		</div>
											    	</div>
												</div>
											</div>
											{!! Form::close() !!}
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