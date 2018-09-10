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
						<h4>Lista de asistentes</h4>
					</div>
					<br/>
					<div class="row" style="align-self: left"> 
						<div class="col-md-3" style="margin-left: 20px">
						    {!! Form::open(array('route' => 'user.search2','id'=> 'form', 'method' => 'POST','class' => 'd-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0', 'autocomplete'=>'off') ) !!}
						    	<div>
									<select class="form-control" name="buscador" id="buscador">
										<option id="0">Buscar Por...</option>
										<option id="1">Nombre</option>
										<option id="2">Apellido</option>
										<option id="4">Nombre de Usuario</option>
									</select>
								</div>
								<br/>
						        <div class="input-group">
						          <input type="text" class="form-control" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2" id="buscar" name="buscar">
						          <div class="input-group-append">
						            <button class="btn btn-primary" type="submit">
						              <i class="fa fa-search"></i>
						            </button>
						          </div>
						        </div>
						        <br/>
				        <a class="btn btn-primary" href="{{route('user.asistente')}}">Ver Lista Completa</a>

						    {!! Form::close() !!}
						</div>
					</div>
					<div class="card-body">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th width="10px">ID</th>
									<th>Nombre</th>
									<th>Nombre de Usuario</th>
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
									<td>{{$user->nombre1." ".$user->nombre2." ".$user->nombre3." ".$user->apellido1." ".$user->apellido2}}</td>
									<td>
										{{$user->name}}
									</td>
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
										<button type="button" class="btn btn-sm btn-default btn btn-danger" data-toggle="modal" data-target="#Modal2">
						  					Eliminar
										</button>
										{!! Form::open(['route' => ['user.destroy', $user->id],'method' => 'DELETE']) !!}
											<!-- Modal -->
											<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
									<td width="10px">
										<a href="{{ route('user.revoke', ['user' =>$user->id, 'idrol' => $sub]) }}" class="btn btn-sm btn-default bg-warning" style="color: white">Revocar Permisos
										</a>
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