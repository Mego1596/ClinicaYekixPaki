<div class="container">
	<div class="col-md-4 col-md-offset-2">
		<div class="form-group">
			{{ Form::label('name', 'Nombre del Role') }}
			{{ Form::text('name', null, ['class' => 'form-control','align' => 'justify'])}}
		</div>
	</div>


	<div class="col-md-4 col-md-offset-2">
		<div class="form-group">
			{{ Form::label('slug', 'URL Amigable') }}
			{{ Form::text('slug', null, ['class' => 'form-control'])}}
		</div>
	</div>


	<div class="col-md-4 col-md-offset-2">
		<div class="form-group">
			{{ Form::label('description', 'Descripcion') }}
			{{ Form::text('description', null, ['class' => 'form-control'])}}
		</div>
	</div>
</div>

	<div class="col-md-4 ">
		<div class="form-group">
			<h3>Permiso Especial</h3>
			<div class="form-group">
				<label>{{ Form::radio('special', 'all-access') }} Acceso Total </label>
				<label>{{ Form::radio('special', 'no-access') }} Ningun Acceso </label>
			</div>
			<h3>Lista de Permisos:</h3><br>
			<ul class="navbar-nav ml-auto">
				@foreach($permissions as $permission)
					<li>
						<label>
							{{ Form::checkbox('permissions[]',$permission->id,null) }}
							{{ $permission->name }}
							<em>({{ $permission->description ?:'N/A' }})</em>
						</label>
					</li>
				@endforeach
			</ul>
		</div>
	</div>


	<div class="col-md-4 col-md-offset-2">
		<div class="form-group">
			{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-success']) }}
		</div>
	</div>
</div>