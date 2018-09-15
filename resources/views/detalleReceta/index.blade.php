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
								<a href="{{route('receta.index', $id2)}}" class="btn btn-block btn-secondary">
								Atrás</a>
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
											Crear
										</a>
										@endcan
									</th>
									@else
									<th colspan="3" width="237">
										@can('detalleRecetas.create')
										<a href="{{ route('detalleReceta.create', ['receta' => $id, 'cita' => $id2 ]) }}" class="btn btn-block btn-success pull-right">
											Crear
										</a>
										@endcan
									</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($detalles as $proceso)
								<tr>
									<td>{{$proceso->medicamento}}</td>
									<td width="10px">
										@can('detalleRecetas.show')
											<a href="{{ route('detalleReceta.show', ['receta' => $id, 'cita' => $id2,'detalle'=> $proceso->id ]) }}" class="btn btn-sm btn-default bg-info" style="color: white">Ver
											</a>
										@endcan
									</td>
									<td width="10px">
										@can('detalleRecetas.edit')
											<a href="{{ route('detalleReceta.edit',['receta' => $id ,'detalle' => $proceso->id,'cita'=> $id2 ]) }}" class="btn btn-sm btn-default bg-success" style="color: white">Editar</a>
										@endcan
									</td>
									<td width="10px">
										@can('detalleRecetas.destroy')
											{!! Form::open(['route' => ['detalleReceta.destroy', $proceso->id],
											'method' => 'DELETE']) !!}
												<button class="btn btn-sm btn-default bg-danger" style="color: white">
													Eliminar
												</button>
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