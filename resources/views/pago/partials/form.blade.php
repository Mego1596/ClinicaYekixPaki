
{{ Form::label('doctorAsignado', 'Realizo el Tratamiento:',['style' => 'visibility:display', 'id' => 'doctorAsignado1']) }}

<div class="row"> 
		<div class="col-md-4 col-sm-12"> 
			<select style="visibility: display;" id="realizoTto" class="form-control" name="realizoTto">
				<option selected="selected" value> Elija un Odontologo</option>
				@foreach($users as $doctor)
					<option value="Dr.{{$doctor->nombre1.' '.$doctor->nombre2.' '.$doctor->nombre3.' '.$doctor->apellido1.' '.$doctor->apellido2.'- '.$doctor->numeroJunta}}">Dr. {{$doctor->nombre1.' '.$doctor->nombre2.' '.$doctor->nombre3.' '.$doctor->apellido1.' '.$doctor->apellido2.'- '.$doctor->numeroJunta}}</option>
				@endforeach
			</select>
		</div>
</div>

<br />
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('abono', 'Abono:',['style' => 'visibility:display', 'id' => 'abono1']) }}
			{{ Form::number('abono', null, ['class' => 'form-control', 'step' => '0.10', 'min'=>'0','max'=>'99999.99','required'])}}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('proximaCita', 'Proxima Cita(d/m/a)*:') }}
			{{ Form::date('proximaCita', null, ['class' => 'form-control', 'type'=>'date','required','placeholder' => 'dd/mm/aaaa']) }}
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

