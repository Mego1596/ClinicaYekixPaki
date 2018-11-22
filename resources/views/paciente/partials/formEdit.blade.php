<div class="row">
		<div class="col-md-2">
			<div class="form-group{{$errors->has('nombre1') ? ' has-error':'' }}">
				{{ Form::label('nombre1', 'Primer nombre *') }}
				{{ Form::text('nombre1', null, ['class' => 'form-control '.($errors->has('nombre1')?'is-invalid':'')])}}
				
				@if($errors->has('nombre1'))
				<div class="form-control-feedback text-danger">
					{{$errors->first('nombre1')}}
				</div>
				@endif
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group{{$errors->has('nombre2') ? ' has-error':'' }}">
				{{ Form::label('nombre2', 'Segundo nombre ') }}
				{{ Form::text('nombre2', null, ['class' => 'form-control '.($errors->has('nombre2')?'is-invalid':'')])}}
	
				@if($errors->has('nombre2'))
				<div class="form-control-feedback text-danger">
					{{$errors->first('nombre2')}}
				</div>		
				@endif
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group{{$errors->has('nombre3') ? ' has-error':'' }}">
				{{ Form::label('nombre3', 'Tercer nombre ', ['style' => 'display:none','id'=>'nombre3.2']) }}
				{{ Form::text('nombre3', null, ['class' => 'form-control '.($errors->has('nombre1')?'is-invalid':''), 'style'=>'display:none', 'id' => 'nombre3'])}}
				
				@if($errors->has('nombre3'))
				<div class="form-control-feedback text-danger">
					{{$errors->first('nombre3')}}
				</div>
				@endif
			</div>
		</div>
		<div class="col-sm-2">
			<div class="form-group">
				{{ Form::label('nombres', '¿Agregar un tercer Nombre? ', ['style' => 'visibility:visible', 'id'=>'nombres']) }}
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
				{{ Form::text('apellido1', null, ['class' => 'form-control '.($errors->has('apellido1')?'is-invalid':'')])}}
				
				@if($errors->has('apellido1'))
				<div class="form-control-feedback text-danger">
					{{$errors->first('apellido1')}}
				</div>
				@endif
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group{{$errors->has('apellido2') ? ' has-error':'' }}">
				{{ Form::label('apellido2', 'Segundo apellido ') }}
				{{ Form::text('apellido2', null, ['class' => 'form-control '.($errors->has('apellido2')?'is-invalid':'')])}}
				
				@if($errors->has('apellido2'))
				<div class="form-control-feedback text-danger">
					{{$errors->first('apellido2')}}
				</div>		
				@endif
			</div>
		</div>
		<div class="col-md-3{{$errors->has('fechaNacimiento') ? ' has-error':'' }}">
			{{ Form::label('fechaNacimiento', 'Fecha de nacimiento *') }}
			{{ Form::date('fechaNacimiento', null, ['class' => 'form-control '.($errors->has('fechaNacimiento')?'is-invalid':''), 'type'=>'date', 'style'=>'height: 38px']) }}
			
			@if($errors->has('fechaNacimiento'))
			<div class="form-control-feedback text-danger">
				{{$errors->first('fechaNacimiento')}}
			</div>
			@endif
		</div>
		<div class="col-md-3{{$errors->has('telefono') ? ' has-error':'' }}">
			{{ Form::label('telefono', 'Telefono *') }}
			{{ Form::text('telefono', null, ['class'=>'form-control '.($errors->has('telefono')?'is-invalid':'')]) }}
		
			@if($errors->has('telefono'))
			<div class="form-control-feedback text-danger">
				{{$errors->first('telefono')}}
			</div>
			@endif
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4{{$errors->has('ocupacion') ? ' has-error':'' }}">
			{{ Form::label('ocupacion', 'Ocupacion *') }}
			{{ Form::text('ocupacion', null, ['class' => 'form-control '.($errors->has('ocupacion')?'is-invalid':'')]) }}
			
			@if($errors->has('ocupacion'))
			<div class="form-control-feedback text-danger">
				{{$errors->first('ocupacion')}}
			</div>
			@endif
	
		</div>
		<div class="col-md-3{{$errors->has('sexo') ? ' has-error':'' }}">
			{{ Form::label('sexo', 'Sexo *') }}
			{{ Form::select('sexo', ['M'=>'Masculino', 'F'=>'Femenino'], null, ['placeholder'=>'Seleccione...', 'class'=>'form-control '.($errors->has('sexo')?'is-invalid':'')]) }}
			
			@if($errors->has('sexo'))
			<div class="form-control-feedback text-danger">
				{{$errors->first('sexo')}}
			</div>
			@endif
	
	
		</div>
	
		<div class="col-md-3{{$errors->has('email') ? ' has-error':'' }}">
			{{ Form::label('email', 'Correo Electronico') }}
			{{ Form::email('email', null, ['class'=>'form-control '.($errors->has('email')?'is-invalid':'')]) }}
			@if($errors->has('email'))
			<div class="form-control-feedback text-danger">
				{{$errors->first('email')}}
			</div>
			@endif
		</div>
		<div class="col-md-6">
			<div class="form-group{{$errors->has('recomendado') ? ' has-error':'' }}">
				{{ Form::label('recomendado','Recomendado Por')}}
				{{ Form::text('recomendado',null,['class' => 'form-control '.($errors->has('recomendado')?'is-invalid':'')])}}
				
				@if($errors->has('recomendado'))
				<div class="form-control-feedback text-danger">
					{{$errors->first('recomendado')}}
				</div>
				@endif
	
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group{{$errors->has('historiaOdontologica') ? ' has-error':'' }}">
				{{ Form::label('historiaOdontologica','Historia Odontologica')}}
				{{ Form::text('historiaOdontologica',null,['class' => 'form-control '.($errors->has('historiaOdontologica')?'is-invalid':'')])}}
				
				@if($errors->has('historiaOdontologica'))
				<div class="form-control-feedback text-danger">
					{{$errors->first('historiaOdontologica')}}
				</div>
				@endif
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4{{$errors->has('domicilio') ? ' has-error':'' }}">
			{{ Form::label('domicilio', 'Domicilio *') }}
			{{ Form::textarea('domicilio', null, ['class'=>'form-control '.($errors->has('domicilio')?'is-invalid':''),'rows'=>'3']) }}
			
			@if($errors->has('domicilio'))
			<div class="form-control-feedback text-danger">
				{{$errors->first('domicilio')}}
			</div>
			@endif
		</div>
		<div class="col-md-4{{$errors->has('direccion_de_trabajo') ? ' has-error':'' }}">
			{{ Form::label('direccion_de_trabajo', 'Direccion de trabajo') }}
			{{ Form::textarea('direccion_de_trabajo', null, ['class'=>'form-control '.($errors->has('direccion_de_trabajo')?'is-invalid':''),'rows'=> '3']) }}
	
			@if($errors->has('direccion_de_trabajo'))
			<div class="form-control-feedback text-danger">
				{{$errors->first('direccion_de_trabajo')}}
			</div>
			@endif
		
		</div>
		<div class="col-md-4{{$errors->has('responsable') ? ' has-error':'' }}">
			{{ Form::label('responsable', 'Responsable') }}
			{{ Form::textarea('responsable', null, ['class'=>'form-control '.($errors->has('responsable')?'is-invalid':''),'rows'=>'3']) }}
			
			@if($errors->has('responsable'))
			<div class="form-control-feedback text-danger">
				{{$errors->first('responsable')}}
			</div>
			@endif
	
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group {{$errors->has('anexo') ? ' has-error': ''}}">
				{{ Form::label('anexo', 'Añandir archivos') }}
				{{ Form::file('anexo[]',['multiple','class'=>'form-control '.($errors->has('anexo')?'is-invalid':'')]) }}

				@if($errors->has('anexo'))
				<div class="form-control-feedback text-danger">
					{{$errors->first('anexo')}}
				</div>
				@endif
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