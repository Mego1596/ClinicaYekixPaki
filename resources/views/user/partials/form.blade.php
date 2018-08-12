<div class="container" align="center">
	<div class="col-md-7 col-md-offset-2">
		<div class="form-group">
			{{ Form::label('name', 'Nombre Completo') }}
			{{ Form::text('name', null, ['class' => 'form-control'])}}
		</div>
	</div>
</div>
<div class="container" align="center">
	<div class="col-md-4 col-md-offset-2">
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
	<div class="col-md-4 col-md-offset-2">
		<div class="form-group">
			{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-success']) }}
		</div>
	</div>
</div>
