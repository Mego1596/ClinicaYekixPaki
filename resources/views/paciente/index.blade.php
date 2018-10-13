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
					@can('pacientes.create')
					<div class="row"> 
						<div class="col-md-2 col-sm-12" style="margin-left: 2%">
					    {!! Form::open(array('route' => 'paciente.search','id'=> 'form', 'method' => 'POST','autocomplete'=>'off') ) !!}
								<select class="form-control" name="buscador" id="buscador">
									<option id="0">Buscar Por...</option>
									<option id="1">Nombre</option>
									<option id="2">Apellido</option>
									<option id="3" selected>Expediente</option>
									<option id="4">Nombre de Usuario</option>
								</select>
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
					    		<a class="btn btn-primary" href="{{route('paciente.index')}}"><i class="fa fa-list"></i> Ver Lista Completa</a>
				    		{!! Form::close() !!}
				    	</div>
				    	@endcan
					</div>
					<div class="card-body">
						<table class="table table-striped table-hover table-responsive-md">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>No. Expediente</th>
									<th>Nombre de Usuario</th>
									@can('pacientes.trabajo')
									<th style="text-align: center;">Plan de Tratamiento</th>
									@endcan
									@if (sizeof($pacientes) == 0)
										<th width="237">
											@can('pacientes.create')
											<a href="{{ route('paciente.create') }}" class="btn btn-success btn-block">
											<i class="fa fa-user-plus"></i>	Crear
											</a>
											@endcan
										</th>
									@else
										@if($bloqueoOrdenado != 0)
										<th colspan="3" width="237">
											@can('pacientes.create')
											<a href="{{ route('paciente.create') }}" class="btn btn-success btn-block">
											<i class="fa fa-user-plus"></i>	Crear paciente
											</a>
											@endcan
										</th>
										@endif
									@endif
								</tr>
							</thead>
							<tbody>
									@foreach($pacientes as $paciente)
										@if($paciente->habilitado == true)
											@if($paciente->user_id !=null)
												@foreach($user as $users)
													@if($paciente->user_id == $users->id)
														@foreach($eventos as $cita)	
																@if($cita->paciente_id == $paciente->id)
																		@php
																			$ninguna = 0;
																		@endphp
																		<tr>
																			<td>{{$paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1." ".$paciente->apellido2}}</td>
																			<td>{{$paciente->expediente}}</td>
																			<td>{{$users->name}}</td>
																			@can('pacientes.trabajo')
																			<td style="text-align: center;"><a href="{{route('planTratamiento.index',['cita'=> $cita->id,'validador' => 1])}}" class="btn btn-sm btn-default bg-dark" style="color: white">Ver Plan Activo</a>
																			</td>
																			@endcan
																			<td width="10px">
																			@can('pacientes.show')
																				<a href="{{ route('paciente.show', $paciente->id) }}" class="btn btn-sm btn-default bg-info" style="color: white"><i class="fa fa-folder-open-o"></i> Expediente
																				</a>
																			@endcan
																			</td>
																			<td width="10px">
																				@can('pacientes.edit')
																					<a href="{{ route('paciente.edit', $paciente->id) }}" class="btn btn-sm  btn-default bg-success" style="color: white"><i class="fa fa-edit"></i> Editar</a>
																				@endcan
																			</td>
																		</tr>
																		@break
																@else($cita->paciente_id != $paciente->id)
																	@php
																		$ninguna = $loop->iteration+1;
																	@endphp
																	@if($ninguna == sizeof($eventos)+1)
																		<tr>
																			<td>{{$paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1." ".$paciente->apellido2}}</td>
																			<td>{{$paciente->expediente}}</td>
																			<td>{{$users->name}}</td>
																			<td></td>
																			<td width="10px">
																				@can('pacientes.show')
																					<a href="{{ route('paciente.show', $paciente->id) }}" class="btn btn-sm btn-default bg-info" style="color: white"><i class="fa fa-folder-open-o"></i> Expediente
																					</a>
																				@endcan
																			</td>
																			<td width="10px">
																				@can('pacientes.edit')
																					<a href="{{ route('paciente.edit', $paciente->id) }}" class="btn btn-sm  btn-default bg-success" style="color: white"><i class="fa fa-edit"></i> Editar</a>
																				@endcan
																			</td>
																		</tr>
																	@endif
																@endif
														@endforeach
													@endif
												@endforeach
											@else
												@foreach($eventos as $cita)	
													@if($cita->paciente_id == $paciente->id)
														@php
															$ninguna = 0;
														@endphp
														<tr>
															<td>{{$paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1." ".$paciente->apellido2}}</td>
															<td>{{$paciente->expediente}}</td>
															<td>Sin Usuario</td>
																			@if($paciente->id == 1)
																			<td></td>
																			<td width="10px" colspan="2">
																				@can('pacientes.show')
																					<a href="{{ route('paciente.show', $paciente->id) }}" class="btn btn-sm btn-default bg-info" style="color: white;width: 100%"><i class="fa fa-folder-open-o"></i> Expediente
																					</a>
																				@endcan
																			</td>
																			@else
																			<td width="10px">
																				@can('pacientes.show')
																					<a href="{{ route('paciente.show', $paciente->id) }}" class="btn btn-sm btn-default bg-info" style="color: white"><i class="fa fa-folder-open-o"></i> Expediente
																					</a>
																				@endcan
																			</td>
																			@endif
																			@if($paciente->id != 1)
																			@can('pacientes.trabajo')
																				<td style="text-align: center;"><a href="{{route('planTratamiento.index',['cita'=> $cita->id,'validador' => 1])}}" class="btn btn-sm btn-default bg-dark" style="color: white">Ver Plan Activo</a>
																				</td>
																			@endcan
																			<td width="10px">
																				@can('pacientes.edit')
																					<a href="{{ route('paciente.edit', $paciente->id) }}" class="btn btn-sm  btn-default bg-success" style="color: white"><i class="fa fa-edit"></i> Editar</a>
																				@endcan
																			</td>
																			@endif
																			@if($paciente->id != 1)
																			@endif
																		</tr>
																		@break
																@else($cita->paciente_id != $paciente->id)
																	@php
																		$ninguna = $loop->iteration+1;
																	@endphp
																	@if($ninguna == sizeof($eventos)+1)
																		<tr>
																			<td>{{$paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1." ".$paciente->apellido2}}</td>
																			<td>{{$paciente->expediente}}</td>
																			<td>Sin Usuario</td>
																			<td></td>
																			</td>
																			@if($paciente->id == 1)
																			<td width="10px" colspan="3">
																				@can('pacientes.show')
																					<a href="{{ route('paciente.show', $paciente->id) }}" class="btn btn-sm btn-default bg-info" style="color: white;width: 100%"><i class="fa fa-folder-open-o"></i> Expediente
																					</a>
																				@endcan
																			</td>
																			@else
																			<td width="10px">
																				@can('pacientes.show')
																					<a href="{{ route('paciente.show', $paciente->id) }}" class="btn btn-sm btn-default bg-info" style="color: white"><i class="fa fa-folder-open-o"></i> Expediente
																					</a>
																				@endcan
																			</td>
																			@endif
																			@if($paciente->id != 1)

																			<td width="10px">
																				@can('pacientes.edit')
																					<a href="{{ route('paciente.edit', $paciente->id) }}" class="btn btn-sm  btn-default bg-success" style="color: white"><i class="fa fa-edit"></i> Editar</a>
																				@endcan
																			</td>
																			@endif
																			@if($paciente->id != 1)
																			@endif
																		</tr>
																	@endif
																@endif
														@endforeach
											@endif
										@else
											@if($paciente->user_id !=null)
												
											@else
												<tr style="background: #ffb3b3">
													<td>{{$paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1." ".$paciente->apellido2}}</td>
													<td>{{$paciente->expediente}}</td>
													<td></td>
													<td></td>
													<td colspan="3">
														@can('pacientes.habilitarPaciente')
															<button type="button" class="btn btn-sm btn-default btn btn-success" data-toggle="modal" data-target="#Modal{{$paciente->id}}" style="width: 100%">
											  				<i class="fa fa-check"></i>	  Habilitar
															</button>
															{!! Form::open(['route' => ['paciente.habilitarPaciente', $paciente->id],'method' => 'POST']) !!}
																	<!-- Modal -->
															<div class="modal fade" id="Modal{{$paciente->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																<div class="modal-dialog" role="document">
																    	<div class="modal-content">
																    		<div class="modal-header">
																        		<h5 class="modal-title" id="exampleModalLabel"> Habilitar Paciente</h5>
																        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																          				<span aria-hidden="true">&times;</span>
																        			</button>
																      		</div>
																      		<div class="modal-body">
																      			<label>Estas seguro?</label>
																      			<br/>
																      			<button type="button" class="btn btn-md btn-default" data-dismiss="modal">No</button>
																        		<button class="btn btn-md btn-default bg-success" style="color: white">
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