@if($modoCrear || Auth::user()->roles[0]->id != 3)
{{ Form::label('doctorAsignado', 'Realizo el Tratamiento: *',['style' => 'visibility:display', 'id' => 'doctorAsignado1']) }}
<div class="row"> 
		<div class="col-md-4 col-sm-12"> 
			<select style="visibility: display;" id="realizoTto" class="form-control" name="realizoTto" required>
				<option selected="selected" value=""> Elija un Odontologo</option>
				@foreach($users as $doctor)
					@if(isset($pago))
					<option {{($pago->realizoTto==$doctor->nombre1.' '.$doctor->nombre2.' '.$doctor->nombre3.' '.$doctor->apellido1.' '.$doctor->apellido2.'- '.$doctor->numeroJunta? "selected":"")}} value="{{$doctor->id}}">Dr. {{$doctor->nombre1.' '.$doctor->nombre2.' '.$doctor->nombre3.' '.$doctor->apellido1.' '.$doctor->apellido2.'- '.$doctor->numeroJunta}}</option>
					@else
					<option value="{{$doctor->id}}">Dr. {{$doctor->nombre1.' '.$doctor->nombre2.' '.$doctor->nombre3.' '.$doctor->apellido1.' '.$doctor->apellido2.'- '.$doctor->numeroJunta}}</option>
					@endif
				@endforeach
			</select>
			@if($errors->has('realizoTto'))
			<div class="form-control-feedback text-danger">
				{{$errors->first('realizoTto')}}
			</div>		
			@endif
		</div>
</div>

<br />
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('abono', 'Abono: *',['style' => 'visibility:display', 'for' => 'abono1']) }}
			{{ Form::number('abono', null, ['id' => 'abono1', 'class' => 'form-control '.($errors->has('abono')?'is-invalid':''), 'step' => '0.10', 'min'=>'0','max'=>'99999.99','required'])}}
		</div>
	</div>
</div>
@endif

@if($errors->has('abono'))
<div class="form-control-feedback text-danger">
		{{$errors->first('abono')}}
	</div>		
@endif

<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('proximaCita', 'Próxima Cita: ',['for' => 'proximaCita']) }}
			{{ Form::date('proximaCita', null, ['class' => 'form-control '.($errors->has('proximaCita')?'is-invalid':'') ]) }}
		</div>
	</div>
</div>

@if($errors->has('proximaCita'))
<div class="form-control-feedback text-danger">
		{{$errors->first('proximaCita')}}
	</div>		
@endif
<div class="row pt-3">
	<div class="col-md-4">
		*Campos obligatorios
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::button('Verificar Info', ['id' => 'btnVerificar', 'class' => 'btn btn-block btn-lg btn-primary', 'onclick' => 'verificarInfo()']) }}
			{{ Form::submit('Guardar', ['id' => 'btnEnviar', 'class' => 'btn btn-block btn-lg btn-success', 'style' => 'visibility:hidden']) }}
		</div>
	</div>
</div>

<!--Modal de verificacion de datos-->
<div class="modal fade" id="verificarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title" id="exampleModalLabel">¿Los Datos Están Correctos?</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
					<div class="form-group">
							<label for="odontologo">Odontólogo</label>
							<input id="odontologo" type="text" class="form-control" id="odontologo" disabled>
					</div>

					<div class="form-group">
							<label for="abono">Abono</label>
							<input id="abono" type="text" class="form-control" id="abono" disabled>
					</div>

					<div class="form-group">
						<label for="proxima">Próxima Cita</label>
						<input id="proxima" type="date" class="form-control" disabled>
				</div>
					<p id="informacion" style="visibility: hidden"></p>
					<p><strong>¿Los datos de pago son correctos?</strong> <code>Una vez guardados no se podrá revertir la operación</code></p>
			</div>
			<div class="modal-footer">
			  <button id="no" type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
			  <button id="si" type="button" class="btn btn-warning" data-dismiss="modal" onclick="habilitarEnvio()">Si</button>
			</div>
		  </div>
		</div>
</div>

