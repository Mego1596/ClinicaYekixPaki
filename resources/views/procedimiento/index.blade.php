@extends('layouts.base')

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						Procedimientos
						@can('procedimiento.create')
						<a href="{{ route('procedimiento.create') }}" class="btn btn-sm btn-success pull-right">
							Crear
						</a>
						@endcan
					</div>
					<div class="panel-body">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th width="10px">ID</th>
									<th>Nombre</th>
								</tr>
							</thead>
							<tbody>
								@foreach($procedimientos as $proceso)
								<tr>
									<td>{{$proceso->id}}</td>
									<td>{{$proceso->nombre}}</td>
									<td width="10px">
										@can('procedimiento.show')
											<a href="{{ route('procedimiento.show', $proceso->id) }}" class="btn btn-sm btn-default bg-info" style="color: white">Ver
											</a>
										@endcan
									</td>
									<td width="10px">
										@can('procedimiento.edit')
											<a href="{{ route('procedimiento.edit', $proceso->id) }}" class="btn btn-sm btn-default bg-success" style="color: white">Editar</a>
										@endcan
									</td>
									<td width="10px">
										@can('procedimiento.destroy')
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