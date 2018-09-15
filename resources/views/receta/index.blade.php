@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a href="/events">Citas</a>
</li>

<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Receta</a>
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
								<a href="/events" class="btn btn-block btn-secondary">
								Atrás</a>
							</div>
							<div class="col-md-10">
								<h4>Lista de recetas</h4>
							</div>
					</div>
					</div>
					<div class="card-body">
						<table class="table table-striped table-hover" >
							<thead>
								<tr>
									<th width="10px">ID</th>
									<th>Receta Para</th>
									@if (sizeof($recetas) == 0)
									<th width="237">
										@can('recetas.create')
										<a href="{{ route('receta.create',['cita' =>$id]) }}" class="btn btn-block btn-success pull-right">
											Crear
										</a>
										@endcan
									</th>
									@else
									<th colspan="4" width="237">
										@can('recetas.create')
										<a href="{{ route('receta.create',['cita' =>$id]) }}" class="btn btn-block btn-success pull-right">
											Crear
										</a>
										@endcan
									</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($recetas as $receta)
								<tr>
									<td>{{$receta->id}}</td>
									<td>{{$paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1." ".$paciente->apellido2}}</td>
									<td width="10px">
										@can('recetas.show')
											<a href="{{ route('receta.show',['cita' => $id, 'receta' => $receta->id])}}" class="btn btn-sm btn-default bg-info" style="color: white" target="_blank">Ver
											</a>
										@endcan
									</td>
									<td width="10px">
										@can('recetas.create')
											<a href="{{ route('detalleReceta.index',['cita' => $id, 'receta' => $receta->id])}}" class="btn btn-sm btn-default bg-primary" style="color: white">Detalles Receta
											</a>
										@endcan
									</td>
									<td width="10px">
										@can('recetas.edit')
											<a href="{{ route('receta.edit',['cita' => $id, 'receta' => $receta->id]) }}" class="btn btn-sm btn-default bg-success" style="color: white">Editar</a>
										@endcan
									</td>
									<td width="10px">
										@can('recetas.destroy')
											{!! Form::open(['route' => ['receta.destroy', $receta->id],
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
						{{$recetas->render()}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection