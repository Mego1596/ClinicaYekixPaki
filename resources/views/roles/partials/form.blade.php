<div class="form-group">
	{{ Form::label('name', 'Nombre del Rol *') }}
	{{ Form::text('name', null, ['class' => 'form-control','align' => 'justify'])}}
</div>

<div class="form-group">
	{{ Form::label('slug', 'URL Amigable *') }}
	{{ Form::text('slug', null, ['class' => 'form-control'])}}
</div>

<div class="form-group">
	{{ Form::label('description', 'Descripcion') }}
	{{ Form::text('description', null, ['class' => 'form-control'])}}
</div>

	<div class="form-group">
		<h3>Permiso Especial</h3>
		<div class="form-group">
			<div class="row">
				<div class="col-md-3">
					<div class="input-group">
					  <div class="input-group-prepend">
					    <div class="input-group-text">
					      <input type="radio" name="special" value="all-access">
					    </div>
					  </div>
					  <label class="form-control">Acceso total</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="input-group">
					  <div class="input-group-prepend">
					    <div class="input-group-text">
					      <input type="radio" name="special" value="no-access">
					    </div>
					  </div>
					  <label class="form-control">Ningun acceso</label>
					</div>
				</div>
			</div>
		</div>
		<h3>Lista de Permisos:</h3><br>
		<div data-spy="scroll" data-target="#navbar-example3" data-offset="0">
			  
		</div>
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
</div>