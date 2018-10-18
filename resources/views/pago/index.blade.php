@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a href="/events">Citas</a>
</li>
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Gestion de Pago</a>
</li>
@endsection


@section('content')
<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card panel-default">
					<div class="card-header text-center">
						<div class="row">
			            	<div class="col-md-2 col-sm-12">
			                	<a href="/events" class="btn btn-block btn-secondary" style="width: 100%">
			                	<i class="fa fa-arrow-circle-left"></i> Atrás</a>
			              	</div>
			              	<div class="col-md-8">
								<h4>Realizar Pago</h4>
			              	</div>
          				</div>

					</div>
					<div class="card-body">
						<table class="table table-striped table-hover table-responsive-md" >
							<thead>
								<tr align="center">
									<th>Fecha</th>
									<th>Tratamiento Realizado</th>
									<th>Realizo el Tratamiento</th>
									<th>Abono</th>
									<th>Saldo</th>
									<th>Proxima Cita</th>
									@if (sizeof($pagos) == 0)
									<th width="237">
										@can('procedimientos.create')
										<a href="{{ route('pago.create',['cita' => $id]) }}" class="btn btn-block btn-success pull-right">
										<i class="fa fa-money"></i>	
										Crear Pago
										</a>
										@endcan
									</th>
									@else
									<th colspan="3" width="237">
										@can('procedimientos.create')
										<a href="{{ route('pago.create', ['cita' => $id]) }}" class="btn btn-block btn-success pull-right">
										<i class="fa fa-money"></i>	
										Crear Pago
										</a>
										@endcan
									</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($pagos as $proceso)
								<tr>
									@php
										$date=date_create($proceso->created_at);
										$aux= date_format($date,"d-m-Y");
									@endphp
									<td width="106px" align="center">{{$aux}}</td>
									<td width="100px" align="center">{{$procesoNombre}}</td>
									<td align="center"></td>
									<td align="center">${{$proceso->abono}}</td>
									<td align="center">${{$proceso->saldo}}</td>
									@php
										$date=date_create($proceso->proximaCita);
										$aux= date_format($date,"d-m-Y");
									@endphp
									<td align="center">{{$aux}}</td>
									<td width="10px">
										@can('procedimientos.edit')
											<a href="{{ route('procedimiento.edit', $proceso->id) }}" class="btn btn-sm btn-default bg-success" style="color: white"><i class="fa fa-edit"></i> Editar</a>
										@endcan
									</td>
									<td width="10px">
										@can('procedimientos.destroy')
											<button type="button" class="btn btn-sm btn-default btn btn-danger" data-toggle="modal" data-target="#Modal{{$proceso->id}}"><i class="fa fa-trash"></i>
													  					Eliminar
																	</button>
																	{!! Form::open(['route' => ['pago.destroy', $proceso->id],'method' => 'DELETE']) !!}
																		<!-- Modal -->
																		<div class="modal fade" id="Modal{{$proceso->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																			<div class="modal-dialog" role="document">
																		    	<div class="modal-content">
																		    		<div class="modal-header">
																		        		<h5 class="modal-title" id="exampleModalLabel">Eliminar Pago</h5>
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
								@endforeach
							</tbody>
						</table>
						{{$pagos->render()}}
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection