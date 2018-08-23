@extends('layouts.base')

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="card panel-default">
					<div class="card-header text-center">
						<h4>Lista de procedimientos</h4>
					</div>
					<div class="card-body">
						<table class="table table-striped table-hover" >
							<thead>
								<tr>
									<th width="10px">ID</th>
									<th>Nombre</th>
									@if (sizeof($procedimientos) == 0)
									<th width="237">
										@can('procedimientos.create')
										<a href="{{ route('procedimiento.create') }}" class="btn btn-block btn-success pull-right">
											Crear
										</a>
										@endcan
									</th>
									@else
									<th colspan="3" width="237">
										@can('procedimientos.create')
										<a href="{{ route('procedimiento.create') }}" class="btn btn-block btn-success pull-right">
											Crear
										</a>
										@endcan
									</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($procedimientos as $proceso)
								<tr>
									<td>{{$proceso->id}}</td>
									<td>{{$proceso->nombre}}</td>
									<td width="10px">
										@can('procedimientos.show')
											<a href="{{ route('procedimiento.show', $proceso->id) }}" class="btn btn-sm btn-default bg-info" style="color: white">Ver
											</a>
										@endcan
									</td>
									<td width="10px">
										@can('procedimientos.edit')
											<a href="{{ route('procedimiento.edit', $proceso->id) }}" class="btn btn-sm btn-default bg-success" style="color: white">Editar</a>
										@endcan
									</td>
									<td width="10px">
										@can('procedimientos.destroy')
											{!! Form::open(['route' => ['procedimiento.destroy', $proceso->id],
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
						{{$procedimientos->render()}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection