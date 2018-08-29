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
						<h4>Lista de Pacientes</h4>
					</div>
					<div class="card-body">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th width="10px">ID</th>
									<th>Nombre</th>
									<th>No. Expediente</th>
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
								<tr>
									<td>{{$paciente->id}}</td>
									<td>{{$paciente->nombre1." ".$paciente->nombre2." ".$paciente->apellido1." ".$paciente->apellido2}}</td>
									<td>{{$paciente->expediente}}</td>
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