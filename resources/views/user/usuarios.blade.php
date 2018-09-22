@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Usuarios</a>
</li>
@endsection

@section('javascript')
<script type="text/javascript">
$(document).ready(function(){
    $("#seteador").click(function(){
    	$("#rol").val("");
   	});
	
	});
</script>
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
								<h4>{{$head}}</h4>
			              	</div>
          				</div>
					</div>
					<br/>
					@role('admin')
					<div class="row" style="align-self: left"> 
						<div style="margin-left: 33px">
						    {!! Form::open(array('route' => 'user.search3','id'=> 'form', 'method' => 'POST','class' => 'd-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0', 'autocomplete'=>'off') ) !!}
						    	<div>
									<select class="form-control" name="buscador" id="buscador">
										<option id="0">Buscar Por...</option>
										<option id="1">Nombre</option>
										<option id="2">Apellido</option>
										<option id="4" selected>Nombre de Usuario</option>
									</select>
								</div>
						</div>
						<div style="margin-left: 0px">
						        <div class="input-group">
						          <input type="text" class="form-control" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2" id="buscar" name="buscar">
						          <div class="input-group-append">
						            <button class="btn btn-primary" type="submit">
						              <i class="fa fa-search"></i>
						            </button>
						          </div>
						        </div>
						</div>
						<div style="margin-left: 15px">
							<a class="btn btn-primary" href="{{route('user.usuario')}}"><i class="fa fa-list"></i> Ver Lista Completa</a>
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
									<th>Rol de Usuario</th>
									<th></th>
									<th> </th>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)
									@foreach($resultados as $result)
										@foreach($roles as $rol)
											@if($result->user_id == $user->id && $result->role_id == $rol->id)
												@if($result->role_id != 4)
													
												@else
													<tr>
															<td>{{$user->nombre1." ".$user->nombre2." ".$user->nombre3." ".$user->apellido1." ".$user->apellido2}}</td>
															<td>
																{{$user->name}}
															</td>
															@if($result->role_id == $rol->id)
																<td>
																	{{$rol->name}}
																</td>
															@endif
															<td width="10px">
																@can('users.destroy')
																<button type="button" class="btn btn-sm btn-default btn btn-danger" data-toggle="modal" data-target="#Modal{{$user->id}}"><i class="fa fa-trash"></i> 
												  					Eliminar
																</button>
																{!! Form::open(['route' => ['user.destroy', $user->id,$sub],'method' => 'DELETE']) !!}
																	<!-- Modal -->
																	<div class="modal fade" id="Modal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		<div class="modal-dialog" role="document">
																	    	<div class="modal-content">
																	    		<div class="modal-header">
																	        		<h5 class="modal-title" id="exampleModalLabel"> Eliminar Odontologo</h5>
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
															@can('users.usuarios')
															<td width="100px">
																<button type="button" class="btn btn-sm btn-default btn btn-success" data-toggle="modal" data-target="#Modal2{{$user->id}}">
												  				<i class="fa fa-plus-square" style="color: white"></i> 	Habilitar Permisos
																</button>
																{!! Form::open(['route' => ['user.grant', $user->id],'method' => 'POST']) !!}
																	<!-- Modal -->
																	<div class="modal fade" id="Modal2{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		<div class="modal-dialog" role="document">
																	    	<div class="modal-content">
																	    		<div class="modal-header">
																	        		<h5 class="modal-title" id="exampleModalLabel"> Otorgar Permisos</h5>
																	        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	          				<span aria-hidden="true">&times;</span>
																	        			</button>
																	      		</div>
																	      		<div class="modal-body">
																					{!! Form::select('rol',['3'=>'Asistente','2'=>'Odontologo'],null,['placeholder'=>'Seleccione...','class'=>'form-control','id' => 'rol'] )!!}
																	      			<br />
																	      			<label>Estas seguro?</label>
																	      			<br/>
																	      			<button type="button" id="seteador" name="seteador" class="btn btn-md btn-default" data-dismiss="modal" onclick="myFunction()">No</button>
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
												@endif
											@endif
										@endforeach
									@endforeach
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
