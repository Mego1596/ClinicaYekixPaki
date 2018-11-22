<div class="form-group">
	{{ Form::label('nombre', 'Nombre del Procedimiento *') }}
	{{ Form::text('nombre', null, ['class' => 'form-control '.($errors->has('nombre')?'is-invalid':''),'required'])}}
		@if($errors->has('nombre'))
		<div class="form-control-feedback text-danger">
			{{$errors->first('nombre')}}
		</div>
		@endif

</div>
<div class="form-group">
	{{ Form::label('descripcion', 'Descripcion del Procedimiento *') }}
	{{ Form::textarea('descripcion', null, ['class' => 'form-control '.($errors->has('descripcion')?'is-invalid':''),'required'])}}
	@if($errors->has('descripcion'))
	<div class="form-control-feedback text-danger">
		{{$errors->first('descripcion')}}
	</div>
	@endif
</div>
<div class="form-group">
	{{ Form::label('color', 'Identificador del Procedimiento *') }}
	{{ Form::input('color', 'color', null, array('class' => 'input-big '.($errors->has('color')?'is-invalid':''))) }}
	@if($errors->has('color'))
	<div class="form-control-feedback text-danger">
		{{$errors->first('color')}}
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