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
          <div class="row">
              <div class="col-md-1">
                <a href="/home" class="btn btn-block btn-secondary" style="width: 130%">
                <i class="fa fa-arrow-circle-left"></i>Atrás</a>
              </div>
              <div class="col-md-10">
                <h3 align="center">Citas:</h3>
              </div>
          </div>
          <div class="row">
          <div class="col-md-3">
            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#ModalX">
                <i class="fa fa-list"></i>  Leyenda de Procedimientos
              </button>
            {!! Form::open() !!}
            <!-- Modal -->
            <div class="modal fade" id="ModalX" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Identificador de Procedimientos</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body" style="overflow-y: auto; max-height: calc(70vh - 150px);">
                        <div class="row">
                          <table align="center">
                            <tr>
                              <td style="text-align: left; background: black;color: white" width="200px">
                              Revision General
                              </td>
                            </tr>
                            <tr>
                              <td style="color: white">.</td>
                            </tr>
                            @foreach($procesos as $p)
                            <tr>
                                <td style="text-align: left; background: {{$p->color}};color: white" width="200px">
                                  {{$p->nombre}}
                                </td>
                            </tr>
                            <tr>
                              <td style="color: white">.</td>
                            </tr>
                            @endforeach
                          </table>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
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
      <div class="modal-body"  style="overflow-y: auto; max-height: calc(100vh - 150px);">
      	<input type="hidden" name="txtID" id="txtID"/>
      	<input type="hidden" name="txtFecha" id="txtFecha"/>
        <input type="hidden" name="txtPaciente_id" id="txtPaciente_id">
        <div class="form-group">
          {!! Form::label('txtExpediente', 'Expediente:')!!}
          {!! Form::text('txtExpediente', null, ['class' => 'form-control','disabled'])!!}
        </div>
      	<div class="form-row">	
      		<div class="form-group col-md-12">
      			{!! Form::label('paciente_id', 'Paciente:',['id' => 'tit']) !!}
      			{!! Form::text('paciente_id', null, ['class' => 'form-control', 'placeholder' => 'Titulo del Evento', 'id' => 'txtTitulo']) !!}
      		</div>
      	</div>
        <div class="form-group">
          {!! Form::label('start_date','Hora Inicio de la Cita:')!!}
          <div class="input-group clockpicker " data-autoclose="true">
            {!! Form::text('start_date', null, ['class' => 'form-control', 'disabled']) !!}
            <span class="input-group-addon" style="display:none">
              <i class="btn btn-primary">
              <span class="fa fa-clock-o"></span>
              </i>
            </span>
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('end_date','Hora Fin de la Cita:')!!}
          <div class="input-group clockpicker " data-autoclose="true">
            {!! Form::text('end_date', null, ['class' => 'form-control', 'disabled']) !!}
            <span class="input-group-addon" style="display:none">
              <i class="btn btn-primary">
              <span class="fa fa-clock-o"></span>
              </i>
            </span>
          </div>
        </div>
      	<div class="form-group">
      		{!! Form::label('txtDescripcion', 'Descripcion:')!!}
      		{!! Form::textarea('txtDescripcion', null, ['class' => 'form-control', 'rows' => '2'])!!}
      	</div>
        @can('planTratamientos.index')
        <div class="row">
          <div class="col-md-4">
              <a class="btn btn-info" href="#" name="plan" id="plan">
              <i class="fa fa-list-alt"></i> Gestionar Plan de Tratamiento</a>
          </div>
        </div>
        @endcan
        @can('recetas.index')
        <div class="row">
          <div class="col-md-4" style="margin-top: 10px">
              <a class="btn btn-info" href="#" name="receta" id="receta">
              <i class="fa fa-file-text-o"></i> Gestionar Receta</a>
          </div>
        </div>
        @endcan
        @can('pacientes.create')
          <div class="row">
            <div class="col-md-4" style="margin-top: 10px">
              <a class="btn btn-info" href="#" style="color: white" name="modificar" id="modificar"><i class="fa fa-address-card-o"></i> Gestionar Cita</a>
            </div>
          </div>
        @endcan
      <div class="modal-footer">
		{!! Form::submit('Añadir Cita', ['class' => 'btn btn-success','id' => 'btnAgregar', 'name' => 'btnAgregar']) !!}
		{!! Form::submit('Modificar Cita', ['class' => 'btn btn-success','id' => 'btnModificar','name' => 'btnModificar']) !!}
		{!! Form::submit('Borrar', ['class' => 'btn btn-danger ','id' => 'btnEliminar','name' => 'btnEliminar']) !!}
    {!! Form::submit('Asignar', ['class' => 'btn btn-info','id'=> 'btnAsignar', 'name'=>'btnAsignar']) !!}
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
        document.getElementById("receta").onclick = function() {
          var x=parseInt($('#txtID').val());
          this.setAttribute("href","receta/"+x);
          //this.setAttribute("href","{{route('planTratamiento.index', ['cita' => ''])}}" )
        }
        document.getElementById("modificar").onclick = function() {
          var x=parseInt($('#txtPaciente_id').val());
          this.setAttribute("href","paciente/"+x+"/events");
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