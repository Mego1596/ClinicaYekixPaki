@extends('layouts.base')
@section('bread')
<li class="breadcrumb-item">
  <a href="/events">Citas</a>
</li>
<li class="breadcrumb-item">
  <a href="{{route('receta.index', $id2)}}">Recetas</a>
</li>

<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Detalle Receta</a>
</li>
@endsection
@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card panel-default">
					<div class="card-header text-center">
						<div class="row">
							<div class="col-md-1">
								<a href="{{route('receta.index', $id2)}}" class="btn btn-block btn-secondary" style="width: 130%">
								<li class="fa fa-arrow-circle-left"></li> Atrás</a>
							</div>
							<div class="col-md-10">
								<h4>Detalles de la Receta</h4>
							</div>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-striped table-hover table-responsive-md" >
							<thead>
								<tr>
									<th>Nombre</th>
									@if (sizeof($detalles) == 0)
									<th width="237">
										@can('detalleRecetas.create')
										<a href="{{ route('detalleReceta.create', ['receta' => $id, 'cita' => $id2 ]) }}" class="btn btn-block btn-success pull-right">
											<li class="fa fa-plus-square"></li>	Crear Detalle de Receta
										</a>
										@endcan
									</th>
									@else
										@if(sizeof($detalles) < 2)
									<th colspan="3" width="237">
										@can('detalleRecetas.create')
										<a href="{{ route('detalleReceta.create', ['receta' => $id, 'cita' => $id2 ]) }}" class="btn btn-block btn-success pull-right">
											<li class="fa fa-plus-square"></li>	Crear Detalle de Receta
										</a>
										@endcan
									</th>
										@endif
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($detalles as $proceso)
								<tr>
									<td>{{$proceso->medicamento}}</td>
									<td width="10px">
										@can('detalleRecetas.show')
											<a href="{{ route('detalleReceta.show', ['receta' => $id, 'cita' => $id2,'detalle'=> $proceso->id ]) }}" class="btn btn-sm btn-default bg-info" style="color: white"><li class="fa fa-file-text-o"></li> Ver
											</a>
										@endcan
									</td>
									<td width="10px">
										@can('detalleRecetas.edit')
											<a href="{{ route('detalleReceta.edit',['receta' => $id ,'detalle' => $proceso->id,'cita'=> $id2 ]) }}" class="btn btn-sm btn-default bg-success" style="color: white"><li class="fa fa-edit"></li> Editar</a>
										@endcan
									</td>
									<td width="10px">
										@can('detalleRecetas.destroy')
											<button type="button" class="btn btn-sm btn-default btn btn-danger" data-toggle="modal" data-target="#Modal{{$proceso->id}}"> <li class="fa fa-trash"></li>
													  					Eliminar
																	</button>
																	{!! Form::open(['route' => ['detalleReceta.destroy', $proceso->id],'method' => 'DELETE']) !!}
																		<!-- Modal -->
																		<div class="modal fade" id="Modal{{$proceso->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																			<div class="modal-dialog" role="document">
																		    	<div class="modal-content">
																		    		<div class="modal-header">
																		        		<h5 class="modal-title" id="exampleModalLabel">Eliminar Detalle de Receta</h5>
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
						{{$detalles->render()}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection