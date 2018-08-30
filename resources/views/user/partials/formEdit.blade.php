<div class="row">
	<div class="col-md-2">
		{{ Form::hidden('idRole', $idRole , ['class' => 'form-control'])}}
		<div class="form-group">
			{{ Form::label('nombre1', 'Primer Nombre*') }}
			{{ Form::text('nombre1', null, ['class' => 'form-control'])}}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('nombre2', 'Segundo Nombre') }}
			{{ Form::text('nombre2', null, ['class' => 'form-control'])}}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('nombre3', 'Tercer nombre ', ['style' => 'display:none','id'=>'nombre3.2']) }}
			{{ Form::text('nombre3', null, ['class' => 'form-control', 'style'=>'display:none', 'id' => 'nombre3'])}}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
		{{ Form::label('nombres', 'Agregar un 3° Nombre? ', ['style' => 'visibility:visible', 'id'=>'nombres']) }}
		<br/>
		<input type="checkbox" name="cosa" value="1" id="cosa" >
		{{ Form::label('radio', 'Si ', ['style' => 'visibility:visible','id' => 'radio']) }}
		<input type="checkbox" name="cosa2" value="2" id="cosa2" >
		{{ Form::label('radio2', 'No ', ['style' => 'visibility:visible','id' => 'radio2']) }}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		{{ Form::hidden('role',$idRole, ['class' => 'form-control']) }}
		<div class="form-group">
			{{ Form::label('apellido1', 'Primer apellido *') }}
			{{ Form::text('apellido1', null, ['class' => 'form-control'])}}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('apellido2', 'Segundo apellido ') }}
			{{ Form::text('apellido2', null, ['class' => 'form-control'])}}
		</div>
	</div>
	@if($idRole=='Dentista')
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('numeroJunta', 'Numero de Junta*') }}
			{{ Form::text('numeroJunta', null, ['class' => 'form-control'])}}
		</div>
	</div>
	@endif
</div>

<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('description', 'E-Mail*') }}
			{{ Form::text('email', null, ['class' => 'form-control'])}}
		</div>
	</div>
	
</div>

<div class="row">
	<div class="col-md-3 ">
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
<div class="row pt-3">
	<div class="col-md-4">
		*Campos obligatorios
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::submit('Guardar', ['class' => 'btn btn-block btn-lg btn-success']) }}
		</div>
	</div>
</div>