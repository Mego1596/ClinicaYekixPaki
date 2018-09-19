@extends('layouts.base')

@section('content')
<div class="container p-5">
	<div class="row justify-content-center">
		<div class="col-lg-10 col-12">
			<div class="row justify-content-between text-center">
            	@can('pacientes.trabajo')
				<div class="col-md-3" name="citas">
					<div class="row">
						<div class="col-12">
								<a href="{{route('events.index')}}" class="btn btn-block btn-light">
									<i class="fa fa-calendar" style="font-size: 150px"></i>
								</a>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<h5>Agenda</h5>
						</div>
					</div>
				</div>
				@endcan
				@can('procedimientos.index')
				<div class="col-md-3" name="procedimientos">
					<div class="row">
						<div class="col-12">
								<a href="{{route('procedimiento.index')}}" class="btn btn-block btn-light">
									<i class="fa fa-list" style="font-size: 150px"></i>
								</a>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<h5>Procedimientos</h5>
						</div>
					</div>
				</div>
				@endcan
				@can('users.index')
				<div class="col-md-3" name="doctores">
					<div class="row">
						<div class="col-12">
							<a href="{{route('user.index')}}" class="btn btn-block btn-light">
								<i class="fa fa-user-md" style="font-size: 150px"></i>
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-12"><h5>Doctores</h5></div>
					</div>
				</div>
				@endcan
			</div>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-lg-10 col-12">
			<div class="row justify-content-between text-center">
				@can('users.asistente')
				<div class="col-md-3" name="asistentes">
					<div class="row">
						<div class="col-12">
						<a href="{{route('user.asistente')}}" class="btn btn-block btn-light">
							<i class="	fa fa-handshake-o" style="font-size: 150px"></i>
						</a>
						</div>
					</div>
					<div class="row">
						<div class="col-12"><h5>Asistentes</h5></div>
					</div>
				</div>
				@endcan
				@can('pacientes.index')
				<div class="col-md-3" name="pacientes">
					<div class="row">
						<div class="col-12">
							<a href="{{route('paciente.index')}}" class="btn btn-block btn-light">
								<i class="fa fa-group" style="font-size: 150px"></i>
							</a>	
						</div>
					</div>
					<div class="row">
						<div class="col-12"><h5>Pacientes</h5></div>
					</div>
				</div>
				@endcan
				@can('roles.index')
				<div class="col-md-3" name="roles">
					<div class="row">
						<div class="col-12">
							<a href="{{route('roles.index')}}" class="btn btn-block btn-light">
								<i class="fa fa-user" style="font-size: 150px"></i>
							</a>		
						</div>
					</div>
					<div class="row">
						<div class="col-12"><h5>Roles</h5></div>
					</div>
				</div>
				@endcan
			</div>
		</div>
	</div>
</div>

@endsection

