<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('nombre1', 'Primer nombre *') }}
			{{ Form::text('nombre1', null, ['class' => 'form-control'])}}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('nombre2', 'Segundo nombre *') }}
			{{ Form::text('nombre2', null, ['class' => 'form-control'])}}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('apellido1', 'Primer apellido *') }}
			{{ Form::text('apellido1', null, ['class' => 'form-control'])}}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('apellido2', 'Segundo apellido *') }}
			{{ Form::text('apellido2', null, ['class' => 'form-control'])}}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		{{ Form::label('fechaNacimiento', 'Fecha de nacimiento *') }}
		{{ Form::date('fechaNacimiento', \Carbon\Carbon::now(), ['class' => 'form-control', 'type'=>'date', 'style'=>'height: 38px']) }}
	</div>
	<div class="col-md-4">
		{{ Form::label('telefono', 'Telefono *') }}
		{{ Form::text('telefono', null, ['class'=>'form-control']) }}
	</div>
	<div class="col-md-4">
		{{ Form::label('sexo', 'Sexo *') }}
		{{ Form::select('sexo', ['M'=>'Masculino', 'F'=>'Femenino'], null, ['placeholder'=>'Seleccione una opcion', 'class'=>'form-control']) }}
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		{{ Form::label('domicilio', 'Domicilio *') }}
		{{ Form::text('domicilio', null, ['class'=>'form-control']) }}
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		{{ Form::label('direccion_de_trabajo', 'Direccion de trabajo') }}
		{{ Form::text('direccion_de_trabajo', null, ['class'=>'form-control']) }}
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		{{ Form::label('ocupacion', 'Ocupacion *') }}
		{{ Form::text('ocupacion', null, ['class' => 'form-control']) }}
	</div>
	<div class="col-md-8">
		{{ Form::label('responsable', 'Responsable') }}
		{{ Form::text('responsable', null, ['class'=>'form-control']) }}
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