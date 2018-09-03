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
				        <div class="input-group">
				          <input type="text" class="form-control" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2" id="buscar" name="buscar">
				          <div class="input-group-append">
				            <button class="btn btn-primary" type="submit">
				              <i class="fas fa-search"></i>
				            </button>
				          </div>
				        </div>
				        <br/>
				    	<input class="btn btn-primary" type="submit" name="Restablecer" value="Ver Lista Completa">

				    {!! Form::close() !!}.
				    </div>
				    @endcan
					</div>
					<div class="card-body">
						<table class="table table-striped table-hover">
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
									@foreach($user as $users)
										@if($paciente->email == $users->email)
											<tr>
												<td>{{$paciente->id}}</td>

												@if($paciente->nombre2 == 'N/A' && $paciente->nombre3 == 'N/A' && $paciente->apellido2 == 'N/A')
												<td>{{$paciente->nombre1." ".$paciente->apellido1}}</td>
												@endif


												@if($paciente->nombre2 == 'N/A' && $paciente->nombre3 == 'N/A' && $paciente->apellido2 != 'N/A')
												<td>{{$paciente->nombre1." ".$paciente->apellido1." ".$paciente->apellido2}}</td>
												@endif


												@if($paciente->nombre2 != 'N/A' && $paciente->nombre3 == 'N/A' && $paciente->apellido2 == 'N/A')
												<td>{{$paciente->nombre1." ".$paciente->nombre2." ".$paciente->apellido1}}</td>
												@endif


												@if($paciente->nombre2 != 'N/A' && $paciente->nombre3 == 'N/A' && $paciente->apellido2 != 'N/A')
												<td>{{$paciente->nombre1." ".$paciente->nombre2." ".$paciente->apellido1." ".$paciente->apellido2}}</td>
												@endif


												@if($paciente->nombre2 != 'N/A' && $paciente->nombre3 != 'N/A' && $paciente->apellido2 == 'N/A')
												<td>{{$paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1}}</td>
												@endif

												@if($paciente->nombre2 != 'N/A' && $paciente->nombre3 != 'N/A' && $paciente->apellido2 != 'N/A')
												<td>{{$paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1." ".$paciente->apellido2}}</td>
												@endif


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
													@can('pacientes.destroy')
														{!! Form::open(['route' => ['paciente.destroy', $paciente->id],
														'method' => 'DELETE']) !!}
															<button class="btn btn-sm btn-block btn-default bg-danger" style="color: white">
																Eliminar
															</button>
														{!! Form::close() !!}
													@endcan
												</td>
											</tr>
										@endif
									@endforeach
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