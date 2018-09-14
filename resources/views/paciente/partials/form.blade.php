<div class="row">
	<div class="col-md-2">
		<div class="form-group{{$errors->has('nombre1') ? ' has-error':'' }}">
			{{ Form::label('nombre1', 'Primer nombre *') }}
			{{ Form::text('nombre1', null, ['class' => 'form-control','required'
			 ,'title'=>'primer nombre'])}}
			
			@if($errors->has('nombre1'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('nombre1')}}</strong>
			</div>		
			@endif

	</div>
	</div>
	<div class="col-md-2">
		<div class="form-group{{$errors->has('nombre2') ? ' has-error':'' }}">
			{{ Form::label('nombre2', 'Segundo nombre ') }}
			{{ Form::text('nombre2', null, ['class' => 'form-control',
			'title'=>'segundo nombre'])}}
			
			@if($errors->has('nombre2'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('nombre2')}}</strong>
			</div>		
			@endif

		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group{{$errors->has('nombre3') ? ' has-error':'' }}">
			{{ Form::label('nombre3', 'Tercer nombre ', ['style' => 'display:none','id'=>'nombre3.2']) }}
			{{ Form::text('nombre3', null, ['class' => 'form-control', 'style'=>'display:none',
			'title'=>'tercer nombre', 'id' => 'nombre3'])}}

			@if($errors->has('nombre3'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('nombre3')}}</strong>
			</div>		
			@endif

		</div>
	</div>
	<div class="col-sm-2 ">
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
		<div class="form-group{{$errors->has('apellido1') ? ' has-error':'' }}">
			{{ Form::label('apellido1', 'Primer apellido *') }}
			{{ Form::text('apellido1', null, ['class' => 'form-control','required',
			'title'=>'primer apellido'])}}
			
			@if($errors->has('apellido1'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('apellido1')}}</strong>
			</div>		
			@endif

		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group{{$errors->has('apellido2') ? ' has-error':'' }}">
			{{ Form::label('apellido2', 'Segundo apellido ') }}
			{{ Form::text('apellido2', null, ['class' => 'form-control' 
			,'title'=>'segundo apellido'])}}

			@if($errors->has('apellido2'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('apellido2')}}</strong>
			</div>		
			@endif
		</div>
	</div>
	<div class="col-md-3{{$errors->has('fechaNacimiento') ? ' has-error':'' }}">
		{{ Form::label('fechaNacimiento', 'Fecha de nacimiento *') }}
		{{ Form::date('fechaNacimiento', null, ['class' => 'form-control', 'type'=>'date', 
		'style'=>'height: 38px','required','min'=>'1900-01-01','max'=>date("Y-m-d")]) }}
		
		@if($errors->has('fechaNacimiento'))
		<div class="alert alert-warning">
			<strong> {{$errors->first('fechaNacimiento')}}</strong>
		</div>		
		@endif
	</div>

	<div class="col-md-3{{$errors->has('telefono') ? ' has-error':'' }}">
		{{ Form::label('telefono', 'Telefono *') }}
		{{ Form::tel('telefono', null, ['class'=>'form-control',
		'required']) }}
	
	@if($errors->has('telefono'))
	<div class="alert alert-warning">
		<strong> {{$errors->first('telefono')}}</strong>
	</div>		
	@endif
	</div>
</div>

<div class="row">
	<div class="col-md-4{{$errors->has('ocupacion') ? ' has-error':'' }}">
		{{ Form::label('ocupacion', 'Ocupacion *') }}
		{{ Form::text('ocupacion', null, ['class' => 'form-control' ,'title'=>'Ocupación','required']) }}
		
		@if($errors->has('ocupacion'))
		<div class="alert alert-warning">
			<strong> {{$errors->first('ocupacion')}}</strong>
		</div>		
		@endif

	</div>
	<div class="col-md-3{{$errors->has('sexo') ? ' has-error':'' }}">
		{{ Form::label('sexo', 'Sexo *') }}
		{{ Form::select('sexo', ['M'=>'Masculino', 'F'=>'Femenino'], null, 
		['placeholder'=>'Seleccione...', 'class'=>'form-control','required']) }}

		@if($errors->has('sexo'))
		<div class="alert alert-warning">
			<strong> {{$errors->first('sexo')}}</strong>
		</div>		
		@endif
	</div>

	<div class="col-md-3{{$errors->has('email') ? ' has-error':'' }}">
		{{ Form::label('email', 'Correo Electronico') }}
		{{ Form::email('email', null, ['class'=>'form-control','maxlength'=>'90']) }}
		@if($errors->has('email'))
		<div class="alert alert-warning">
			<strong> {{$errors->first('email')}}</strong>
		</div>		
		@endif
	</div>
	<div class="col-md-4">
		<div class="form-group{{$errors->has('recomendado') ? ' has-error':'' }}">
			{{ Form::label('recomendado','Recomendado Por')}}
			{{ Form::text('recomendado',null,['class' => 'form-control'])}}
			@if($errors->has('recomendado'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('recomendado')}}</strong>
			</div>		
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group{{$errors->has('historiaOdontologica') ? ' has-error':'' }}">
			{{ Form::label('historiaOdontologica','Historia Odontologica')}}
			{{ Form::text('historiaOdontologica',null,['class' => 'form-control'])}}
			@if($errors->has('historiaOdontologica'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('historiaOdontologica')}}</strong>
			</div>		
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group{{$errors->has('historiaMedica') ? ' has-error':'' }}">
			{{ Form::label('historiaMedica','Historia Medica')}}
			{{ Form::text('historiaMedica',null,['class' => 'form-control'])}}
			
			@if($errors->has('historiaMedica'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('historiaMedica')}}</strong>
			</div>		
			@endif
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4{{$errors->has('domicilio') ? ' has-error':'' }}">
		{{ Form::label('domicilio', 'Domicilio *') }}
		{{ Form::textarea('domicilio', null, ['class'=>'form-control','rows'=>'3','required']) }}

		@if($errors->has('domicilio'))
		<div class="alert alert-warning">
			<strong> {{$errors->first('domicilio')}}</strong>
		</div>		
		@endif	

	</div>
	<div class="col-md-4{{$errors->has('direccion_de_trabajo') ? ' has-error':'' }}">
		{{ Form::label('direccion_de_trabajo', 'Direccion de trabajo') }}
		{{ Form::textarea('direccion_de_trabajo', null, ['class'=>'form-control','rows'=> '3']) }}
	
		@if($errors->has('direccion_de_trabajo'))
		<div class="alert alert-warning">
			<strong> {{$errors->first('direccion_de_trabajo')}}</strong>
		</div>		
		@endif
	</div>
	<div class="col-md-4{{$errors->has('responsable') ? ' has-error':'' }}">
		{{ Form::label('responsable', 'Responsable') }}
		{{ Form::textarea('responsable', null, ['class'=>'form-control','rows'=>'3']) }}
		
		@if($errors->has('responsable'))
		<div class="alert alert-warning">
			<strong> {{$errors->first('responsable')}}</strong>
		</div>		
		@endif
	</div>
</div>
<br/>

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