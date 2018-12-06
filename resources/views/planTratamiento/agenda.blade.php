@extends('layouts.base')

@section('bread')
<li class="breadcrumb-item">
  <a href="/events">Citas</a>
</li>
<li class="breadcrumb-item">
  <a href="{{ route('planTratamiento.index',['cita'=> $id2, 'validador'=> $validador])}}">Plan de Tratamiento</a>
</li>
<li class="breadcrumb-item">
  <a class="breadcrumb-item active">Proxima Cita</a>
</li>
@endsection


@section('javascript')
<link href="{{ asset('css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection

@section('content')
<!-- en caso de error -->
<div>
  <div class="row">
    <div class="col-md-12 pt-3">
      @if($errors->has('txtFecha'))
      <div class="alert alert-warning">
         {{$errors->first('txtFecha')}}
      </div>
      @elseif($errors->has('start_date'))
      <div class="alert alert-warning">
        {{$errors->first('start_date')}}
      </div>		
      @elseif($errors->has('end_date'))
      <div class="alert alert-warning">
        {{$errors->first('end_date')}}
      </div>
      @elseif($errors->has('RangoStartHora'))
      <div class="alert alert-warning">
         {{$errors->first('RangoStartHora')}}
      </div>
      @elseif($errors->has('RangoEndHora'))
      <div class="alert alert-warning">
        {{$errors->first('RangoEndHora')}}
      </div>
      @elseif($errors->has('RangoLibre'))
      <div class="alert alert-warning">
       {{$errors->first('RangoLibre')}}
      </div>
      @elseif($errors->has('notEqualFree'))
      <div class="alert alert-warning">
       {{$errors->first('notEqualFree')}}
      </div>
      @elseif($errors->has('horasFijas'))
      <div class="alert alert-warning">
       {{$errors->first('horasFijas')}}
      </div>
      @elseif($errors->has('choques'))
      <div class="alert alert-warning">
       {{$errors->first('choques')}}
      </div>
      @elseif($errors->has('minCita'))
      <div class="alert alert-warning">
       {{$errors->first('minCita')}}
      </div>
      @elseif($errors->has('maxCita'))
      <div class="alert alert-warning">
       {{$errors->first('maxCita')}} 
      </div>
      @elseif($errors->has('notRangoFree'))
      <div class="alert alert-warning">
       {{$errors->first('notRangoFree')}}
      </div>
      @endif
    </div>
  </div>
</div>
 <div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
    <div class="panel-heading">
          <div class="row">
              <div class="col-md-2">
                <a href="{{ route('planTratamiento.index',['cita'=> $id2, 'validador'=> $validador])}}" class="btn btn-block btn-secondary" style="width: 50%">
                <i class="fa fa-arrow-circle-left"></i>Atrás</a>
              </div>
              <div class="col-md-8">
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
              <div class="modal fade" data-backdrop="static" id="ModalX" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Identificador de Procedimientos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="overflow-y: auto; max-height: calc(100vh - 150px);">
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Procedimiento</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>1</td>
                                    <td style="text-align: center; background: black;color: white; border-radius: 10px">
                                      Revision General
                                    </td>
                                  </tr>
                                  @foreach($procesos as $p)
                                  <tr>
                                      <td>{{$loop->iteration+1}}</td>
                                      <td style="text-align: center; background: {{$p->color}};color: white; border-radius: 10px">
                                        {{$p->nombre}}
                                      </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
          <br />
		<div class="panel-body">
				{!! $calendar_details->calendar() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Modal -->
{!! Form::open(array('route' => 'planTratamiento.add','id'=> 'form', 'method' => 'POST', 'autocomplete' => 'off') ) !!}
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
        <input type="hidden" name="plan" id="plan" value='ok'>
        <input type="hidden" name="pacienteID" id="pacienteID" value="{{$paciente->id}}">
        <input type="hidden" name="encendido" id="encendido" value="{{$encendido}}">
        <input type="hidden" name="txtProcedimiento_id" id="txtProcedimiento_id" value="{{$id}}">
        <input type="hidden" name="txtValidador" id="txtValidador" value="{{$validador}}">
        <input type="hidden" name="referencia" id="referencia" value="{{$planActual}}">
        <input type="hidden" name="txtSolvencia" id="txtSolvencia" value="{{$solvente}}">
        @can('pacientes.create')
        <a class="btn btn-primary" href="{{route('planTratamiento.cupo', ['cita'=>$id2 ,'procedimiento'=> $id ,'paciente'=> $paciente,'planTratamiento'=> $planActual, 'validador' => $validador])}}" target="_blank" id="cupos" name="cupos"><i class="fa fa-outdent"></i> Ver Cupos</a>
        @endcan
        <div class="form-row">
          <div class="col-md-12">
            <label for="txtFecha" id="fecha">Fecha:</label>
          </div>
          <div class="col-md-12">
            <input type="date" name="txtFecha" id="txtFecha"/>
          </div>
          </div>
        </div>

      	<div class="form-row">	
      		<div class="col-md-12">
      			{!! Form::label('paciente_id', 'Paciente:',['id' => 'tit']) !!}
          </div>
          <div class="col-md-12"> 
      			{!! Form::text('paciente_id', null, ['class' => 'form-control', 'placeholder' => 'Titulo del Evento', 'id' => 'txtTitulo']) !!}
      			{!! $errors->first('paciente_id','<p class="alert alert-danger">El titulo de la cita es requerido</p>') !!}
      		</div>
      	</div>
        <div class="col-md-12">
          {!! Form::label('start_date','Hora Inicio de la Cita:')!!}
          <div class="input-group clockpicker " data-autoclose="true">
            {!! Form::text('start_date', null, ['class' => 'form-control']) !!}
            <span class="input-group-addon">
              <i class="btn btn-primary">
              <span class="fas fa-clock"></span>
              </i>
            </span>
          </div>
        </div>

        <div class="col-md-12">
          {!! Form::label('end_date','Hora Fin de la Cita:')!!}
          <div class="input-group clockpicker " data-autoclose="true">
            {!! Form::text('end_date', null, ['class' => 'form-control']) !!}
            <span class="input-group-addon">
              <i class="btn btn-primary">
              <span class="fas fa-clock"></span>
              </i>
            </span>
          </div>
        </div>
      	<div class="col-md-12">
      		{!! Form::label('txtDescripcion', 'Descripcion:')!!}
      		{!! Form::textarea('txtDescripcion', null, ['class' => 'form-control', 'rows' => '2', 'id' => 'txtDescripcion'])!!}
      	</div>
        <br />
        @can('pacientes.create')
          <div class="col-md-12">
            {{ Form::label('reprogramacion','¿Cita por reprogramacion?',['id'=>'labelReprogramacion']) }}
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-2">
                {{ Form::radio('reprogramacion', '1', false, ['id'=> 'siReprogramacion'] )}}
                <label for="siReprogramacion" id="siReprogramacion1">Si</label>
              </div>
              <div class="col-md-2">
                {{ Form::radio('reprogramacion', '2', true, ['id'=> 'noReprogramacion'] )}}
                <label for="noReprogramacion" id="noReprogramacion1">No</label>
              </div>
            </div>
          </div>          
        @endcan
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

    <!-- Page level plugin JavaScript-->
    <script src="{{ asset('js/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.js')}}"></script>
    <!-- Demo scripts for this page-->
    <script src="{{ asset('js/datatables-demo.js')}}"></script>
@endsection