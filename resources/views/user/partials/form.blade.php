<div class="row">
	<div class="col-md-3">
		{{ Form::hidden('idRole', $idRole , ['class' => 'form-control'])}}
		<div class="form-group">
			{{ Form::label('nombre1', 'Primer Nombre*') }}
			{{ Form::text('nombre1', null, ['class' => 'form-control','required'])}}

			@if($errors->has('nombre1'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('nombre1')}}</strong>
			</div>		
			@endif
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('nombre2', 'Segundo Nombre') }}
			{{ Form::text('nombre2', null, ['class' => 'form-control'])}}
			@if($errors->has('nombre2'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('nombre2')}}</strong>
			</div>		
			@endif
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('nombre3', 'Tercer nombre ', ['style' => 'display:none','id'=>'nombre3.2']) }}
			{{ Form::text('nombre3', null, ['class' => 'form-control', 'style'=>'display:none', 'id' => 'nombre3'])}}
			@if($errors->has('nombre3'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('nombre3')}}</strong>
			</div>		
			@endif
		</div>
	</div>
	<div class="col-md-3">
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
	<div class="col-md-3">
		{{ Form::hidden('role',$idRole, ['class' => 'form-control']) }}
		<div class="form-group">
			{{ Form::label('apellido1', 'Primer apellido *') }}
			{{ Form::text('apellido1', null, ['class' => 'form-control','required'])}}
			@if($errors->has('apellido1'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('apellido1')}}</strong>
			</div>		
			@endif
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('apellido2', 'Segundo apellido ') }}
			{{ Form::text('apellido2', null, ['class' => 'form-control'])}}
			@if($errors->has('apellido2'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('apellido2')}}</strong>
			</div>		
			@endif
		</div>
	</div>
	@if($idRole=='doctor')
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('numeroJunta', 'Numero de Junta*') }}
			{{ Form::text('numeroJunta', 'JVPO-', ['class' => 'form-control','required'])}}
			@if($errors->has('numeroJunta'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('numeroJunta')}}</strong>
			</div>		
			@endif
		</div>
	</div>
	@endif
	@if($idRole=='asistente')
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('numeroJunta', 'Numero de Junta ', ['style' => 'display:none','id'=>'numeroJunta2']) }}
			{{ Form::text('numeroJunta', null, ['class' => 'form-control', 'style'=>'display:none', 'id' => 'numeroJunta'])}}
			@if($errors->has('numeroJunta'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('numeroJunta')}}</strong>
			</div>		
			@endif
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
		{{ Form::label('nombres', 'Agregar Numero de Junta? ', ['style' => 'visibility:visible', 'id'=>'nombres']) }}
		<br/>
		<input type="checkbox" name="cosa" value="1" id="cosa3" >
		{{ Form::label('radio', 'Si ', ['style' => 'visibility:visible','id' => 'radio']) }}
		<input type="checkbox" name="cosa2" value="2" id="cosa4" >
		{{ Form::label('radio2', 'No ', ['style' => 'visibility:visible','id' => 'radio2']) }}
		</div>
	</div>
	@endif
</div>

<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('description', 'E-Mail') }}
			{{ Form::text('email', null, ['class' => 'form-control'])}}
			@if($errors->has('email'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('email')}}</strong>
			</div>		
			@endif
		</div>
	</div>

	@if($idRole=='doctor')
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('especialidad', 'Especialidad') }}
			{{ Form::text('especialidad', null , ['class' => 'form-control'])}}
			@if($errors->has('especialidad'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('especialidad')}}</strong>
			</div>		
			@endif
		</div>
	</div>
	@endif
	@if($idRole=='asistente')
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('especialidad', 'Especialidad', ['style' => 'display:none','id'=>'especialidad2']) }}
			{{ Form::text('especialidad', null, ['class' => 'form-control', 'style'=>'display:none', 'id' => 'especialidad'])}}
			@if($errors->has('especialidad'))
			<div class="alert alert-warning">
				<strong> {{$errors->first('especialidad')}}</strong>
			</div>		
			@endif
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
		{{ Form::label('nombres', 'Posee Especialidad? ', ['style' => 'visibility:hidden', 'id'=>'nom']) }}
		<br/>
		<input type="checkbox" name="cosa" value="1" id="cosa5" style="display: none" >
		{{ Form::label('radio5', 'Si ', ['style' => 'visibility:hidden','id' => 'radio5']) }}
		<input type="checkbox" name="cosa2" value="2" id="cosa6" style="display: none" >
		{{ Form::label('radio6', 'No ', ['style' => 'visibility:hidden','id' => 'radio6']) }}
		
		</div>
	</div>
	@endif
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
