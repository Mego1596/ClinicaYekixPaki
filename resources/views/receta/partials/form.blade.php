<div class="row">
	{{ Form::hidden('events_id', $id,['class' => 'form-control'])  }}
	<div class="col-md-5">
		<div class="form-group">
			{{ Form::label('nombre', 'Nombre') }}
			{{ Form::text('nombre', $paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1." ".$paciente->apellido2, ['class' => 'form-control', 'disabled'])}}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('peso', 'Peso (lbs) *') }}
			{{ Form::number('peso', null, ['class' => 'form-control '.($errors->has('peso')?'is-invalid':''), 'step' => '0.10', 'min'=>'0','max'=>'600','required'])}}
	
			@if($errors->has('peso'))
			<div class="form-control-feedback text-danger">
					{{$errors->first('peso')}}
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
