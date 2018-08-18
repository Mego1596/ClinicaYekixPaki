@extends('layouts.base')

@section('content')
	<div class="container">
	<!-- DESDE AQUI EL FORMULARIO PARA INGRESAR UN EVENTO
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
	HASTA AQUI EL FORMULARIO PARA INGRESAR UN EVENTO-->
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
{!! Form::open(array('route' => 'events.add','id'=> 'form', 'method' => 'POST') ) !!}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloEvento">Descripcion de la Cita</h5>
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
      			{!! Form::text('event_name', null, ['class' => 'form-control', 'placeholder' => 'Titulo del Evento', 'id' => 'txtTitulo']) !!}
      			{!! $errors->first('event_name','<p class="alert alert-danger">El titulo de la cita es requerido</p>') !!}
      		</div>
      	</div>
      	<div class="form-group">
      		{!! Form::label('start_date','Hora Inicio de la Cita:')!!}
      		<div class="input-group clockpicker" data-autoclose="true">
      			{!! Form::time('start_date', null, ['value'=> '00:00', 'class' => 'form-control'] ) !!}
      			{!! $errors->first('start_date','<p class="alert alert-danger">La Fecha de Inicio es requerida</p>') !!}
      			
      		</div>
      	</div>
      	<div class="form-group">
      		{!! Form::label('end_date','Hora Fin de la Cita:')!!}
      		<div class="input-group clockpicker" data-autoclose="true">
      			{!! Form::time('end_date', null, ['value'=> '00:00', 'class' => 'form-control'] ) !!}
      			{!! $errors->first('end_date','<p class="alert alert-danger">La Fecha de Fin es requerida</p>') !!}
      	</div>
      	<div class="form-group">
      		{!! Form::label('txtDescripcion', 'Descripcion:')!!}
      		{!! Form::textarea('txtDescripcion', null, ['class' => 'form-control', 'rows' => '3'])!!}
      	</div>
      	{!! Form::label('procedimiento_id', 'Procedimiento:')!!}
      	{!! Form::select('procedimiento_id', $procedimiento, null, ['placeholder' => 'Elija un procedimiento'])!!}

      <div class="modal-footer">
		{!! Form::submit('Añadir Cita', ['class' => 'btn btn-success','id' => 'btnAgregar', 'name' => 'btnAgregar']) !!}
		{!! Form::submit('Modificar Cita', ['class' => 'btn btn-success','id' => 'btnModificar','name' => 'btnModificar']) !!}
		{!! Form::submit('Borrar', ['class' => 'btn btn-danger ','id' => 'btnEliminar','name' => 'btnEliminar']) !!}

        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection


@section('calendar')
    {!! $calendar_details->script() !!}

    <script type="text/javascript">

	/*function EnviarInformacion(accion,objEvento,modal){
		$.ajax({
			type:'POST',
			url:'eventos.php?accion='+accion,
			data:objEvento,
			success:function(msg){
				if(msg){
					$('#CalendarioWeb').fullCalendar('refetchEvents');
					if(!modal){
						$('#exampleModal').modal('toggle');
					}
				}
			},
			error:function(){
				alert('Hay un error...');
			}
		});
	}*/

	$('.clockpicker').clockpicker();
		
	function limpiarFormulario(){
		$('#txtID').val("");
		$('#txtDescripcion').val("");
		$('#txtTitulo').val("");
		$('#txtColor').val("");
		$('#start_date').val("");
		$('#end_date').val("");
		$('#procedimiento_id').val("");
	}

</script>
@endsection