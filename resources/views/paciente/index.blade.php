@extends('layouts.base')

@section('content')
	<div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						Pacientes
						@can('pacientes.create')
						<a href="{{ route('paciente.create') }}" class="btn btn-sm btn-success pull-right">
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
								@foreach($pacientes as $paciente)
								<tr>
									<td>{{$paciente->id}}</td>
									<td>{{$paciente->nombre}}</td>
									<td width="10px">
										@can('pacientes.show')
											<a href="{{ route('paciente.show', $paciente->id) }}" class="btn btn-sm btn-default bg-info" style="color: white">Ver
											</a>
										@endcan
									</td>
									<td width="10px">
										@can('pacientes.edit')
											<a href="{{ route('paciente.edit', $paciente->id) }}" class="btn btn-sm btn-default bg-success" style="color: white">Editar</a>
										@endcan
									</td>
									<td width="10px">
										@can('pacientes.destroy')
											{!! Form::open(['route' => ['paciente.destroy', $paciente->id],
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
						{{$pacientes->render()}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection