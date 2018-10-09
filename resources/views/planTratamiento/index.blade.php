@extends('layouts.base')
@section('bread')
<li class="breadcrumb-item">
  <a href="/events">Citas</a>
</li>
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Plan de Tratamiento</a>
</li>
@endsection
@section('content')
<br/>
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card panel-default">
					<div class="card-header text-center">
						<h4>Plan de Tratamiento</h4>
						@foreach($persona as $pacient)
							<h5>
								<label>
									<strong>{{$pacient->nombre1.' '.$pacient->nombre2.' '.$pacient->nombre3.' '.$pacient->apellido1.' '.$pacient->apellido2}}
									</strong>
								</label>
							</h5>
						@endforeach
					</div>
					<div class="card-body">
						<table class="table table-striped table-hover table-responsive-md">
							<thead>
								<tr>
									<th width="10px">ID</th>
									<th>Nombre</th>
									<th>Estado</th>
									<th></th>
									@if($validador != 2)
										@if (sizeof($planTratamiento) == 0)
										<th width="237">
											@can('planTratamientos.create')
											<a href="{{ route('planTratamiento.create', ['cita' =>$id,'validador'=>$validador]) }}" class="btn btn-block btn-success pull-right">
											<i class="fa fa-tasks"></i> 
											<i class="fa fa-plus-square" style="font-size: 10px"></i> Crear Plan de Tratamiento
											</a>
											@endcan
										</th>
										@else
										<th colspan="5" width="237">
											@can('planTratamientos.create')
											<a href="{{ route('planTratamiento.create', ['cita' =>$id,'validador' => $validador])}}" class="btn btn-block btn-success pull-right">
											<i class="fa fa-tasks"></i>
											<i class="fa fa-plus-square" style="font-size: 10px"></i> Crear Plan de Tratamiento
											</a>
											@endcan
										</th>
										@endif
									@else
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($planTratamiento as $proceso)
									<tr>
										<td width="10px">{{$proceso->id}}</td>
										@foreach($proc as $procedimiento)
											@if($proceso->procedimiento_id == $procedimiento->id)
												<td>{{$procedimiento->nombre}}</td>
												@if($proceso->en_proceso == true)
											<td width="150px">
												<label><strong>En Proceso</strong></label>
											</td>
											<td></td>
									@elseif($proceso->completo == true)
											<td width="150px">
												<label><strong>Completo</strong></label>
											</td>
											<td></td>
									@else($proceso->no_iniciado == true)
											<td width="150px">
												<label><strong>No Iniciado</strong></label>
											</td>
											<td></td>
									@endif
												@if($proceso->en_proceso == true)
											<td width="10px">
												@can('planTratamientos.create')
												<a href="{{ route('planTratamiento.agenda',[ 'procedimiento'=> $procedimiento->id, 'paciente'=> $paciente,'planTratamiento'=>$proceso->id] )}}" class="btn btn-sm btn-default bg-dark" style="color: white">Agendar Cita
											</a>
												@endcan
											</td>
									@elseif($proceso->no_iniciado == false)
											<td></td>
									@else
											<td></td>
									@endif
											@endif

										@endforeach
										<td width="10px">
											@can('planTratamientos.show')
												<a href="{{ route('planTratamiento.show', ['cita' =>$id, 'planTratamiento'=> $proceso->id ]) }}" class="btn btn-sm btn-default bg-info" style="color: white">Ver
												</a>
											@endcan
										</td>
										<td width="10px">
											@can('planTratamientos.edit')
												<a href="{{ route('planTratamiento.edit', ['cita' =>$id, 'planTratamiento'=> $proceso->id ]) }}" class="btn btn-sm btn-default bg-success" style="color: white">Editar</a>
											@endcan
										</td>
										<td width="10px">
											@can('planTratamientos.destroy')
												{!! Form::open(['route' => ['planTratamiento.destroy', $proceso->id],
												'method' => 'DELETE']) !!}
													<button class="btn btn-sm btn-default bg-danger" style="color: white">
														Eliminar
													</button>
												{!! Form::close() !!}
											@endcan
										</td> 
										@if(sizeof($planValidador) == 1)
											@if($proceso->en_proceso == true)
												<td width="10px">
													<a href="" class="btn btn-sm btn-default bg-gray" style="background: gray;color: white">Terminar</a>
												</td>
											@else
												<td></td>
											@endif
										@else
											@if($proceso->completo == true)
											<td width="10px"></td>
											@elseif($proceso->no_iniciado == true)
												<td width="10px">
													<a href="" class="btn btn-sm btn-default bg-dark" style="color: white">Iniciar</a>
												</td>
											@else
											@endif
										@endif
									</tr>
								@endforeach
							</tbody>
						</table>
						{{$planTratamiento->render()}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection