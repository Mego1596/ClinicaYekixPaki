<div class="row">
	{{ Form::hidden('receta_id', $id,['class' => 'form-control'])  }}
	<div class="col-md-5">
		<div class="form-group">
			{{ Form::label('medicamento', 'Medicamento*') }}
			{{ Form::text('medicamento', null,['class' => 'form-control '.($errors->has('medicamento')?'is-invalid':''),'required']) }}
			
			@if($errors->has('medicamento'))
			<div class="form-control-feedback text-danger">
					{{$errors->first('medicamento')}}
				</div>	
			@endif

		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-5">
		<div class="form-group">
			{{ Form::label('dosis', 'Dosis*') }}
			{{ Form::text('dosis', null, ['class' => 'form-control '.($errors->has('dosis')?'is-invalid':''),'required'])}}
			
			@if($errors->has('dosis'))
			<div class="form-control-feedback text-danger">
					{{$errors->first('dosis')}}
				</div>	
			@endif

		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-5">
		<div class="form-group">
			{{ Form::label('cantidad', 'Cantidad*') }}
			{{ Form::text('cantidad', null, ['class' => 'form-control '.($errors->has('cantidad')?'is-invalid':''),'required'])}}
			
			@if($errors->has('cantidad'))
			<div class="form-control-feedback text-danger">
					{{$errors->first('cantidad')}}
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