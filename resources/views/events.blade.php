@extends('layouts.base')

@section('content')
	<div class="container">
	<!-- DESDE AQUI EL FORMULARIO PARA INGRESAR UN EVENTO-->
		<div class="panel panel-primary">
			<div class="panel-heading"> 
				<div class="panel-body">
					{!! Form::open(array('route' => 'events.add', 'method' => 'POST', 'files' => 'true')  ) !!}
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								@if (Session::has('success'))
									<div class="alert alert-success">{{ Session::get('success') }}</div>
								@elseif (Session::has('warnning'))
									<div class="alert alert-danger"> {{ Session::get('warnning') }}</div>
								@endif
							</div>

							<div class="col-xs-4 col-sm-4 col-md-5">
								<div class="form-group">
									{!! Form::label('event_name', 'Titulo') !!}
									<div class="">
									{!! Form::text('event_name', null,['class' => 'form-control'])!!}
									{!! $errors->first('event_name','<p class="alert alert-danger">El titulo de la cita es requerido</p>') !!}
									</div>
								</div>
							</div>

							<div class="col-xs-3 col-sm-3 col-md-5">
								<div class="form-group">
									{!! Form::label('start_date','Hora Inicio:')!!}
									<div class="">
									{!! Form::date('start_date', null, ['class' => 'form-control']) !!}
									{!! $errors->first('start_date','<p class="alert alert-danger">La Fecha de Inicio es requerida</p>') !!}
									</div>
								</div>
							</div>

							<div class="col-xs-3 col-sm-3 col-md-5">
								<div class="form-group">
									{!! Form::label('end_date', 'Hora Fin:')!!}
									<div class="">
									{!! Form::date('end_date',null, ['class' => 'form-control']) !!}
									{!! $errors->first('end_date', '<p class="alert alert-danger">La Fecha de Fin  es requerida</p>')!!}
									</div>
								</div>
							</div>
							<div class="col-xs-3 col-sm-3 col-md-3">
								<div class="form-group">
									{!! Form::label('procedimiento_id', 'Procedimiento:')!!}
									<div class="">
									{!! Form::select('procedimiento_id', $procedimiento, null, ['placeholder' => 'Elija un procedimiento'])!!}
									</div>
								</div>
							</div>

							<div class="col-xs-4 col-sm-4 col-md-10 text-center">&nbsp;<br/>
							{!! Form::submit('Añadir Cita', ['class' => 'btn btn-success'])!!}
							</div>
						</div>
						{!! Form::close() !!}
			</div>
		</div>
	</div>
	<!-- HASTA AQUI EL FORMULARIO PARA INGRESAR UN EVENTO-->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 align="center">Citas:</h3></div>
			<div class="panel-body">
				{!! $calendar_details->calendar() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloEvento"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<input type="hidden" name="txtID" id="txtID"/>
      	<input type="hidden" name="txtFecha" id="txtFecha"/>

      	<div class="form-row">	
      		<div class="form-group col-md-12">
      			{!! Form::label('event_name', 'Titulo:') !!}
      			{!! Form::text('event_name', null, ['class' => 'form-control', 'placeholder' => 'Titulo del Evento']) !!}
      		</div>
      	</div>
      	<div class="form-group">
      		<label>Hora Inicio de la Cita:</label>
      		<div class="input-group clockpicker" data-autoclose="true">
      			<input type="time" id="txtHora" value="00:00" class="form-control" />
      		</div>
      	</div>
      	<div class="form-group">
      		<label>Hora Fin de la Cita:</label>
      		<div class="input-group clockpicker" data-autoclose="true">
      			<input type="time" id="txtHora2" value="01:00" class="form-control" />
      		</div>
      	</div>
      	<div class="form-group">
      		<label>Descripcion:</label>
      		<textarea id="txtDescripcion" rows="3" class="form-control"></textarea>	
      	</div>
      	<!--<div class="form-group">
      		   <label>Color:</label>
      		   <input type="color" value="#FF0000" id="txtColor" class="form-control" style="height: 36px;">	
      	</div>
      	-->
      		<label>Tipo de Consulta:</label>
  			<select name="cars" id="txtColor">
  			  <option value="#2e9724">Obturaciones Esteticas (Rellenos)</option>
  			  <option value="#26837c">Endodoncia</option>
  			  <option value="#603bfe">Guardas Oclusales</option>
  			  <option value="#042cfc">Protesis Parciales Fijas</option>
  			  <option value="#000000">Protesis Removibles Parciales y Totales</option>
  			  <option value="#ec6103">Profilaxis y Detartrajes con Ultrasonido (limpiezas)</option>
  			  <option value="#f9096a">Extracciones</option>
  			  <option value="#b49410">Cirujia de Cordales</option>
  			  <option value="#1c7f94">Pulpotomias y Pulpectomias</option>
  			  <option value="#a183dd">Otras</option>
  			</select>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
      	<button type="button" id="btnModificar" class="btn btn-success">Modificar</button>
      	<button type="button" id="btnEliminar" class="btn btn-danger">Borrar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
@endsection


@section('calendar')
    {!! $calendar_details->script() !!}
@endsection