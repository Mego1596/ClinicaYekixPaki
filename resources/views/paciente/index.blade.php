@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Paciente</a>
</li>

@endsection


@section('content')
	<div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header text-center">
						<h4>{{$head}}</h4>
					</div>
					<br/>
					@can('pacientes.create')
					<div class="row" style="align-self: left"> 
					<div class="col-md-3" style="margin-left: 20px">
				    {!! Form::open(array('route' => 'paciente.search','id'=> 'form', 'method' => 'POST','class' => 'd-none d-md-inline-block form-inline ml-auto mr-9 mr-md-5 my-2 my-md-0', 'autocomplete'=>'off') ) !!}
						<div>
							<select class="form-control" name="buscador" id="buscador">
								<option id="0">Buscar Por...</option>
								<option id="1">Nombre</option>
								<option id="2">Apellido</option>
								<option id="3">Expediente</option>
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
				        <a class="btn btn-primary" href="{{route('paciente.index')}}">Ver Lista Completa</a>

				    {!! Form::close() !!}
				    </div>
				    @endcan
					</div>
					<div class="card-body">
						<table class="table table-striped table-hover table-responsive-md">
							<thead>
								<tr>
									<th width="10px">ID</th>
									<th>Nombre</th>
									<th>No. Expediente</th>
									<th>Nombre de Usuario</th>
									@if (sizeof($pacientes) == 0)
										<th width="237">
											@can('pacientes.create')
											<a href="{{ route('paciente.create') }}" class="btn btn-success btn-block">
												Crear
											</a>
											@endcan
										</th>
									@else
										<th colspan="3" width="237">
											@can('pacientes.create')
											<a href="{{ route('paciente.create') }}" class="btn btn-success btn-block">
												Crear paciente
											</a>
											@endcan
										</th>
									@endif
								</tr>
							</thead>
							<tbody>
									@foreach($pacientes as $paciente)
										@if($paciente->user_id !=null)
											@foreach($user as $users)
												@if($paciente->user_id == $users->id)
													<tr>
														<td>{{$paciente->id}}</td>
														<td>{{$paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1." ".$paciente->apellido2}}</td>
														<td>{{$paciente->expediente}}</td>
														<td>{{$users->name}}</td>
														<td width="10px">
															@can('pacientes.show')
																<a href="{{ route('paciente.show', $paciente->id) }}" class="btn btn-sm btn-default bg-info" style="color: white">Ver
																</a>
															@endcan
														</td>
														<td width="10px">
															@can('pacientes.edit')
																<a href="{{ route('paciente.edit', $paciente->id) }}" class="btn btn-sm  btn-default bg-success" style="color: white">Editar</a>
															@endcan
														</td>
														<td width="10px">
															@can('users.destroy')
																<button type="button" class="btn btn-sm btn-default btn btn-danger" data-toggle="modal" data-target="#Modal2">
												  					Eliminar
																</button>
																{!! Form::open(['route' => ['detalleReceta.destroy', $detalles->id],'method' => 'DELETE']) !!}
																	<!-- Modal -->
																	<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																		<div class="modal-dialog" role="document">
																	    	<div class="modal-content">
																	    		<div class="modal-header">
																	        		<h5 class="modal-title" id="exampleModalLabel"> Eliminar Paciente</h5>
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
													</tr>
												@endif
											@endforeach
										@else
											<tr>
												<td>{{$paciente->id}}</td>
												<td>{{$paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1." ".$paciente->apellido2}}</td>
												<td>{{$paciente->expediente}}</td>
												<td>Sin Usuario</td>
												<td width="10px">
													@can('pacientes.show')
														<a href="{{ route('paciente.show', $paciente->id) }}" class="btn btn-sm btn-default bg-info" style="color: white">Ver
														</a>
													@endcan
												</td>
												<td width="10px">
													@can('pacientes.edit')
														<a href="{{ route('paciente.edit', $paciente->id) }}" class="btn btn-sm  btn-default bg-success" style="color: white">Editar</a>
													@endcan
												</td>
												<td width="10px">
													@can('users.destroy')
														<button type="button" class="btn btn-sm btn-default btn btn-danger" data-toggle="modal" data-target="#Modal2">
										  					Eliminar
														</button>
														{!! Form::open(['route' => ['paciente.destroy', $paciente->id],'method' => 'DELETE']) !!}
																<!-- Modal -->
														<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
															<div class="modal-dialog" role="document">
															    	<div class="modal-content">
															    		<div class="modal-header">
															        		<h5 class="modal-title" id="exampleModalLabel"> Eliminar Paciente</h5>
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
											</tr>
										@endif
									@endforeach


							</tbody>
						</table>
						{{$pacientes->render()}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection