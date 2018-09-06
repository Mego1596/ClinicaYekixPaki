@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Citas</a>
</li>
@endsection


@section('content')
	<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 align="center">Citas:</h3></div>
      <div class="row">
        <table>
          <th>Descripcion</th>
          <th>Color</th>
          <tr>
            <td>Revision General</td>
            <td>
              <div style="background-color:#000000; color:#000000">///////</div>
            </td>
          </tr>
          <tr>
              <td style="color: white">.</td>
          </tr>
          @foreach($procesos as $p)
            <tr>
              <td>
                {{$p->nombre}}
              </td>
              <td>
                <div style="background-color:{{$p->color}}; color:{{$p->color}}">///////</div>
              </td>
              <br/>
            </tr>
            <tr>
              <td style="color: white">.</td>
            </tr>
          @endforeach
          </table>
      </div>
      <div class="panel-body">
        <br/>
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
      			{!! Form::label('paciente_id', 'Paciente:',['id' => 'tit']) !!}
      			{!! Form::text('paciente_id', null, ['class' => 'form-control', 'placeholder' => 'Titulo del Evento', 'id' => 'txtTitulo']) !!}
      			{!! $errors->first('paciente_id','<p class="alert alert-danger">El titulo de la cita es requerido</p>') !!}
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
      		{!! Form::textarea('txtDescripcion', null, ['class' => 'form-control', 'rows' => '2'])!!}
      	</div>
        @can('planTratamientos.index')
        <div class="row">
          <div class="col-md-4" style="margin-left: 100px">
              <a class="btn btn-info" href="#" name="plan" id="plan">Gestionar Plan de Tratamiento</a>
          </div>
        </div>
        @endcan

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

<script type="text/javascript">
        document.getElementById("plan").onclick = function() {
          var x=parseInt($('#txtID').val());
          this.setAttribute("href","planTratamiento/"+x);
          //this.setAttribute("href","{{route('planTratamiento.index', ['cita' => ''])}}" )
        }
</script>
    {!! $calendar_details->script() !!}

<script type="text/javascript">

  	$('.clockpicker').clockpicker();
  	function limpiarFormulario(){
  		$('#txtID').val("");
  		$('#txtDescripcion').val("");
  		$('#txtTitulo').val("");
  		$('#txtColor').val("");
  		$('#start_date').val("");
  		$('#end_date').val("");
  		//$('#procedimiento_id').val("");
	 }
</script>
@endsection