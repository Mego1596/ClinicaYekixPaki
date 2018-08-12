<div class="form-group">
	{{ Form::label('name', 'Nombre del Procedimiento') }}
	{{ Form::text('nombre', null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
	{{ Form::label('description', 'Descripcion del Procedimiento') }}
	{{ Form::textarea('descripcion', null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
	{{ Form::label('color', 'Identificador del Procedimiento') }}
	{{ Form::input('color', 'color', null, array('class' => 'input-big')) }}
</div>
<div class="form-group">
	{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-success']) }}
</div>
