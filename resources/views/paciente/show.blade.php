@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a href="/paciente">Paciente</a>
</li>

<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Detalle Paciente</a>
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
								<a href="{{ route('paciente.index') }}" class="btn btn-block btn-secondary">
								Atrás</a>
							</div>
							<div class="col-md-10">
								<h4>Datos del paciente</h4>
							</div>
						</div>
					</div>
					<div class="card-body">
						{!! Form::model($paciente, ['route' => ['paciente.update', $paciente->id]]) !!}
						<div class="row">
							<div class="col-md-2">
								{{ Form::label('created_at', 'Fecha:') }}
								{{ Form::datetime('created_at', null, ['class' => 'form-control','disabled'])}}
							</div>
							<div class="col-md-2">
								{{ Form::label('expediente', 'No. Expediente') }}
								{{ Form::text('expediente', null, ['class' => 'form-control','disabled' ])}}
							</div>
						</div>
						<div class="row pt-3">
							<div class="col-md-2">
								<div class="form-group">
									{{ Form::label('nombre1', 'Primer nombre') }}
									{{ Form::text('nombre1', null, ['class' => 'form-control', 'disabled'])}}
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									{{ Form::label('nombre2', 'Segundo nombre') }}
									{{ Form::text('nombre2', null, ['class' => 'form-control', 'disabled'])}}
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									{{ Form::label('nombre3', 'Tercer nombre') }}
									{{ Form::text('nombre3', null, ['class' => 'form-control', 'disabled'])}}
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									{{ Form::label('apellido1', 'Primer apellido') }}
									{{ Form::text('apellido1', null, ['class' => 'form-control', 'disabled'])}}
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									{{ Form::label('apellido2', 'Segundo apellido') }}
									{{ Form::text('apellido2', null, ['class' => 'form-control', 'disabled'])}}
								</div>
							</div>
						</div>
						<div class="row pt-3">
							<div class="col-md-2">
								{{ Form::label('fechaNacimiento', 'Fecha de nacimiento') }}
								{{ Form::date('fechaNacimiento', \Carbon\Carbon::now(), ['class' => 'form-control', 'type'=>'date', 'style'=>'height: 38px', 'disabled']) }}
							</div>
							<div class="col-md-2">
								{{ Form::label('telefono', 'Telefono') }}
								{{ Form::text('telefono', null, ['class'=>'form-control', 'disabled']) }}
							</div>
							<div class="col-md-2">
								{{ Form::label('sexo', 'Sexo') }}
								{{ Form::text('sexo', null, ['class'=>'form-control', 'disabled']) }}
							</div>
							<div class="col-md-3">
								{{ Form::label('email', 'Correo Electronico') }}
								{{ Form::email('email', null, ['class'=>'form-control', 'disabled']) }}
							</div>
							<div class="col-md-3">
								{{ Form::label('ocupacion', 'Ocupacion') }}
								{{ Form::text('ocupacion', null, ['class' => 'form-control', 'disabled']) }}
							</div>
						</div>
						<div class="row pt-3">
							<div class="col-md-12">
								{{ Form::label('domicilio', 'Domicilio') }}
								{{ Form::text('domicilio', null, ['class'=>'form-control', 'disabled']) }}
							</div>
						</div>
						<div class="row pt-3">
							<div class="col-md-12">
								{{ Form::label('direccion_de_trabajo', 'Direccion de trabajo') }}
								{{ Form::text('direccion_de_trabajo', null, ['class'=>'form-control', 'disabled']) }}
							</div>
						</div>
						<div class="row pt-3">
							<div class="col-md-12">
								{{ Form::label('responsable', 'Responsable') }}
								{{ Form::text('responsable', null, ['class'=>'form-control', 'disabled']) }}
							</div>
						</div>
						<div class="row pt-3">	
							<div class="col-md-12">
								{{ Form::label('recomendado', 'Recomendado por') }}
								{{ Form::email('recomendado', null, ['class'=>'form-control', 'disabled']) }}
							</div>
						</div>
						<div class="row pt-3">
						@can('admin.historiaO')
							<div class="col-md-12">
								{{ Form::label('historiaOdontologica','Historia Odontologica')}}
								{{ Form::textarea('historiaOdontologica',null,['class' => 	'form-control','disabled','rows' => '3'])}}
							</div>
						@endcan
						</div>
						<div class="row pt-3">
							<div class="col-md-3 col-sm-12">
							<a href="{{ route('paciente.agenda', $paciente->id) }}" class="btn btn-block btn-primary bg-primary" role="button">Calendario</a>	
							</div>
							<div class="col-md-5 col-sm-12">
							@can('admin.crearHistoria')
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#Modal2">
							  Crear Historia Medica
							</button>
							@endcan	
							</div>
						</div>
					{!! Form::close() !!}
					</div>
					@can('admin.historiaM')
						<div class="container">
							<div class="row">
								<div class="col-md-4">
									<h5>Historia Médica:</h5>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
	        						<table class="table table-striped table-responsive-md">
	        							<th width="85%">Descripcion</th>
	        							<th></th>
	        							<th></th>
	        							@foreach ($historias as $key) 
	        							<tr>
	        								<td>
		        								{{$key->descripcion}}
			        						</td>
			        						<td width="10px">
												@can('admin.editarHistoria')
												<!-- Button trigger modal -->
												<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal{{$key->id}}">
												  Editar
												</button>
												@endcan
												{!! Form::model($key, ['route' => ['historia.update', $key->id], 'method'=> 'PUT' ] ) !!}
												<!-- Modal -->
												<div class="modal fade" id="exampleModal{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												  <div class="modal-dialog" role="document">
												    <div class="modal-content">
												      <div class="modal-header">
												        <h5 class="modal-title" id="exampleModalLabel"> Historia Medica</h5>
												        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
												          <span aria-hidden="true">&times;</span>
												        </button>
												      </div>
												      <div class="modal-body">
												      	<input type="hidden" name="id" id="id" value="{{$key->id}}">
												      	<textarea name="descripcion" id="descripcion" cols="30" rows="10" 
												      	class="form-control">{{ $key->descripcion }}</textarea>
												        {{-- <input type="text" name="descripcion" id="descripcion" value="{{$key->descripcion}}"> --}}
												      </div>
												      <div class="modal-footer">
												        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
												        <button type="submit" class="btn btn-success">Modificar</button>
												      </div>
												    </div>
												  </div>
												</div>
												{!! Form::close() !!}
											</td>
											@can('admin.eliminarHistoria')
											<td>
											{!! Form::open(['route' => ['historia.destroy', $key->id],
													'method' => 'DELETE']) !!}
														<button class="btn btn-block btn-danger" style="color: white">
															Eliminar
														</button>
													{!! Form::close() !!}
			        						</td>
			        						@endcan
		        						</tr>
							    		@endforeach
									</table>
								</div> 
							</div>
						</div>
					@endcan

					{!! Form::open(['route' => 'historia.store']) !!}
						<!-- Modal -->
						<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
						    	<div class="modal-content">
						    		<div class="modal-header">
						        		<h5 class="modal-title" id="exampleModalLabel"> Historia Medica</h5>
						        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          				<span aria-hidden="true">&times;</span>
						        			</button>
						      		</div>
						      		<div class="modal-body">
						      			<label for="descripcion">Descripci&#243;n:</label>
						      			<textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control"></textarea>
						        		{{-- <input type="text" name="descripcion" id="descripcion" class="form-control"> --}}
						        		<input type="hidden" name="paciente_id" id="paciente_id" value="{{$paciente->id}}">
						      		</div>
						      		<div class="modal-footer">
						        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						        		<button type="submit" class="btn btn-success">Guardar</button>
						      		</div>
						    	</div>
							</div>
						</div>
						{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection