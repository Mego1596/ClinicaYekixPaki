<div class="row">
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('nombre1', 'Primer nombre *') }}
			{{ Form::text('nombre1', null, ['class' => 'form-control'])}}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('nombre2', 'Segundo nombre ') }}
			{{ Form::text('nombre2', null, ['class' => 'form-control'])}}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('nombre3', 'Tercer nombre ', ['style' => 'display:none','id'=>'nombre3.2']) }}
			{{ Form::text('nombre3', null, ['class' => 'form-control', 'style'=>'display:none', 'id' => 'nombre3'])}}
		</div>
	</div>
	<div class="col-sm-2">
		<div class="form-group">
			{{ Form::label('nombres', 'Agregar un 3° Nombre? ', ['style' => 'visibility:visible', 'id'=>'nombres']) }}
			<br/>
			<input type="checkbox" name="cosa" value="1" id="cosa" >
			{{ Form::label('radio', 'Si ', ['style' => 'visibility:visible','id' => 'radio']) }}
			<input type="checkbox" name="cosa2" value="2" id="cosa2" >
			{{ Form::label('radio2', 'No ', ['style' => 'visibility:visible','id' => 'radio2']) }}
		</div>
	</div>
	<div class="col-md-1">
		<div class="form-group">
		</div>
	</div>
	<div class="col-md-2"></div>

	<div class="col-md-2">
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
	<div class="col-md-3">
		{{ Form::label('fechaNacimiento', 'Fecha de nacimiento *') }}
		{{ Form::date('fechaNacimiento', null, ['class' => 'form-control', 'type'=>'date', 'style'=>'height: 38px']) }}
	</div>
	<div class="col-md-3">
		{{ Form::label('telefono', 'Telefono *') }}
		{{ Form::text('telefono', null, ['class'=>'form-control']) }}
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		{{ Form::label('ocupacion', 'Ocupacion *') }}
		{{ Form::text('ocupacion', null, ['class' => 'form-control']) }}
	</div>
	<div class="col-md-3">
		{{ Form::label('sexo', 'Sexo *') }}
		{{ Form::select('sexo', ['M'=>'Masculino', 'F'=>'Femenino'], null, ['placeholder'=>'Seleccione...', 'class'=>'form-control']) }}
	</div>

	<div class="col-md-3">
		{{ Form::label('email', 'Correo Electronico*') }}
		{{ Form::email('email', null, ['class'=>'form-control']) }}
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('recomendado','Recomendado Por')}}
			{{ Form::text('recomendado',null,['class' => 'form-control'])}}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('historiaOdontologica','Historia Odontologica')}}
			{{ Form::text('historiaOdontologica',null,['class' => 'form-control'])}}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('historiaMedica','Historia Medica')}}
			{{ Form::text('historiaMedica',null,['class' => 'form-control'])}}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		{{ Form::label('domicilio', 'Domicilio *') }}
		{{ Form::textarea('domicilio', null, ['class'=>'form-control','rows'=>'3']) }}
	</div>
	<div class="col-md-4">
		{{ Form::label('direccion_de_trabajo', 'Direccion de trabajo') }}
		{{ Form::textarea('direccion_de_trabajo', null, ['class'=>'form-control','rows'=> '3']) }}
	</div>
	<div class="col-md-4">
		{{ Form::label('responsable', 'Responsable') }}
		{{ Form::textarea('responsable', null, ['class'=>'form-control','rows'=>'3']) }}
	</div>
</div>
<br/>
<div class="row">
<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('password', 'Contraseña*') }}
			{{ Form::password('password', ['class' => 'form-control','id'=>'password'])}}
		</div>
	</div>
<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('confirmPassword', 'Confirmar Contraseña*') }}
			{{ Form::password('confirmPassword', ['class' => 'form-control','id'=>'confirmPassword'])}}
		</div>
	</div>
</div>
<div class="row">
	
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