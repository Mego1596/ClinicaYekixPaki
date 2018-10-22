@extends('layouts.base')

@section('bread')

@endsection

@section('content')
 <div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
    <div class="panel-heading">
          <div class="row">
              <div class="col-md-2">
                <a href="{{ route('planTratamiento.index',['cita'=> $id2, 'validador'=> $validador])}}" class="btn btn-block btn-secondary" style="width: 50%">
                <i class="fa fa-arrow-circle-left"></i>Atrás</a>
              </div>
              <div class="col-md-10">
                <h3 align="center">Citas:</h3>
              </div>
          </div>
        <div class="row">
          <div class="col-md-3">
            <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#ModalX"><i class="fa fa-list"></i>
                  Leyenda de Procedimientos
              </button>
              <br />
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
                      <div class="modal-body" style="overflow-y: auto; max-height: calc(100vh - 150px);">
                        <div class="row">
                          <table align="center">
                            <tr>
                              <td style="text-align: center; background: black;color: white; border-radius: 10px" width="200px">
                              Revision General
                              </td>
                            </tr>
                            <tr>
                              <td style="color: white">.</td>
                            </tr>
                            @foreach($procesos2 as $p)
                            <tr>
                                <td style="text-align: center; background: {{$p->color}};color: white; border-radius: 10px;" width="200px">
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
				{!! $calendar_details->calendar() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Modal -->
{!! Form::open(array('route' => 'planTratamiento.add','id'=> 'form', 'method' => 'POST') ) !!}
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
        <input type="hidden" name="cita" id="cita" value="{{$id2}}">
      	<input type="hidden" name="txtFecha" id="txtFecha"/>
        <input type="hidden" name="pacienteID" id="pacienteID" value="{{$paciente->id}}">
        <input type="hidden" name="encendido" id="encendido" value="{{$encendido}}">
        <input type="hidden" name="txtProcedimiento_id" id="txtProcedimiento_id" value="{{$id}}">
        <input type="hidden" name="txtValidador" id="txtValidador" value="{{$validador}}">
        <input type="hidden" name="referencia" id="referencia" value="{{$planActual}}">
        <input type="hidden" name="txtSolvencia" id="txtSolvencia" value="{{$solvente}}">

      	<div class="form-row">	
      		<div class="form-group col-md-12">
      			{!! Form::label('paciente_id', 'Paciente:',['id' => 'tit']) !!}
      			{!! Form::text('paciente_id', null, ['class' => 'form-control', 'placeholder' => 'Titulo del Evento', 'id' => 'txtTitulo']) !!}
      			{!! $errors->first('paciente_id','<p class="alert alert-danger">El titulo de la cita es requerido</p>') !!}
      		</div>
      	</div>
        <div class="form-group">
          {!! Form::label('start_date','Hora Inicio de la Cita:')!!}
          <div class="input-group clockpicker " data-autoclose="true">
            {!! Form::text('start_date', null, ['class' => 'form-control']) !!}
            <span class="input-group-addon">
              <i class="btn btn-primary">
              <span class="fa fa-clock-o"></span>
              </i>
            </span>
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('end_date','Hora Fin de la Cita:')!!}
          <div class="input-group clockpicker " data-autoclose="true">
            {!! Form::text('end_date', null, ['class' => 'form-control']) !!}
            <span class="input-group-addon">
              <i class="btn btn-primary">
              <span class="fa fa-clock-o"></span>
              </i>
            </span>
          </div>
        </div>
      	<div class="form-group">
      		{!! Form::label('txtDescripcion', 'Descripcion:')!!}
      		{!! Form::textarea('txtDescripcion', null, ['class' => 'form-control', 'rows' => '2', 'id' => 'txtDescripcion'])!!}
      	</div>

        <!-- EN EL SELECT VA LA VARIABLE PROCEDIMIENTO -->



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
		//$('#procedimiento_id').val("");
	}

</script>
@endsection