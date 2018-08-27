<div class="container" align="center">
	<div class="col-md-7 col-md-offset-2">
		{{ Form::hidden('idRole', $idRole , ['class' => 'form-control'])}}
		<div class="form-group">
			{{ Form::label('name', 'Nombre Completo') }}
			{{ Form::text('name', null, ['class' => 'form-control'])}}
		</div>
	</div>
</div>
<div class="container" align="center">
	<div class="col-md-4 col-md-offset-2">
		{{ Form::hidden('role',$idRole, ['class' => 'form-control']) }}
		<div class="form-group">
			{{ Form::label('description', 'E-Mail') }}
			{{ Form::text('email', null, ['class' => 'form-control'])}}
		</div>
	</div>
</div>
<div class="container" align="center">
	<div class="col-md-4 col-md-offset-2">
		<div class="form-group">
			{{ Form::label('password', 'Contraseña') }}
			{{ Form::password('password', null, ['class' => 'form-control'])}}
		</div>
	</div>
</div>
<div class="container" align="center">
	<div class="col-md-4 ">
		<div class="form-group">
			<h3>Lista de Roles:</h3><br>
			<ul class="navbar-nav ml-auto">
				@foreach($roles as $role)
					<li>
						<label>
							@if($idRole == 'Dentista')
								@if($role->slug != 'asistente' && $role->slug != 'admin')
								<p>{{ $role->name }}
									{{ Form::checkbox('roles[]',$role->id,null) }}
									<em>({{ $role->description ?:'N/A' }})</em>
								</p>
								@endif
							@endif
							@if($idRole == 'Asistente')
								@if($role->slug != 'doctor' && $role->slug != 'admin')
								<p>{{ $role->name }}
									{{ Form::checkbox('roles[]',$role->id,null) }}
									<em>({{ $role->description ?:'N/A' }})</em>
								</p>
								@endif
							@endif
						</label>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
<div class="container" align="center">
	<div class="col-md-4 col-md-offset-2">
		<div class="form-group">
			{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-success']) }}
		</div>
	</div>
</div>
