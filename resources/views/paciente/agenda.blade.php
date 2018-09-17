@extends('layouts.base')

@section('javascript')
<script>
$(document).ready(function(){
    $("#cosa").click(function(){
        document.getElementById('procedimiento').style.visibility = 'visible';
        document.getElementById('procedimiento_id').style.visibility = 'visible';
        $("#cosa2").prop('checked',false);
        $("#cosa").prop('disabled',true);
        $("#cosa2").prop('disabled',false);
    });
    $("#cosa2").click(function(){
        document.getElementById('procedimiento').style.visibility = 'hidden';
        document.getElementById('procedimiento_id').style.visibility = 'hidden';
        $("#cosa").prop('checked',false);
        $("#cosa2").prop('disabled',true);
        $("#cosa").prop('disabled',false);
        $("#procedimiento_id").val("");
    });

    $("#cosa2").prop('checked',true);
    $("#cosa2").prop('disabled',true);
});
</script>
@endsection

@section('bread')
<li class="breadcrumb-item">
  <a href="/paciente">Paciente</a>
</li>

<li class="breadcrumb-item">
  <a href="/paciente/{{$paciente->id}}">Detalle Paciente</a>
</li>

<li class="breadcrumb-item">
  <a class="breadcrumb-item active" ">Citas</a>
</li>
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
      @endif
    </div>
  </div>
</div>
<!--fin en caso de error-->
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 align="center">Citas:</h3></div>
              <table>
          <tr>
            <td>Revision General o Paciente Referidos con Procedimiento</td>
            <td>
              <input type="color" disabled value="#000000">
            </td>
          </tr>
          <tr>
          @foreach($procesos as $p)
            @if($p->id%2==0)
              <td style="text-align: left;">
                {{$p->nombre}}
              </td>
              <td>
                <input type="color" disabled value="{{$p->color}}">
              </td>
              <td>
                &nbsp;
              </td>
              <td>
                &nbsp;
              </td>
              <td>
                &nbsp;
              </td>
              <td>
                &nbsp;
              </td>
            @endif
          @endforeach
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            @foreach($procesos as $p)
              @if($p->id%2!=0)
                <td>
                  {{$p->nombre}}
                </td>
                <td>
                  <input type="color" disabled value="{{$p->color}}">
                </td>
              <td>
                &nbsp;
              </td>
              <td>
                &nbsp;
              </td>
              <td>
                &nbsp;
              </td>
              <td>
                &nbsp;
              </td>
              @endif
            @endforeach
          </tr>
        </table>
			<div class="panel-body">
				{!! $calendar_details->calendar() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Modal -->
{!! Form::open(array('route' => 'paciente.add','id'=> 'form', 'method' => 'POST', 'autocomplete' => 'off') ) !!}
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
        <input type="hidden" name="pacienteID" id="pacienteID" value="{{$paciente->id}}">
        <input type="hidden" name="encendido" id="encendido" value="{{$encendido}}">

      	<div class="form-row">	
      		<div class="form-group col-md-12">
      			{!! Form::label('paciente_id', 'Paciente:',['id' => 'tit']) !!}
      			{!! Form::text('paciente_id', null, ['class' => 'form-control', 'placeholder' => 'Titulo del Evento', 'id' => 'txtTitulo']) !!}
      			
      		</div>
      	</div>
        <div class="form-group">
          {!! Form::label('start_date','Hora Inicio de la Cita:')!!}
          <div class="input-group clockpicker " data-autoclose="true">
            {!! Form::text('start_date', null, ['class' => 'form-control','required']) !!}
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
            {!! Form::text('end_date', null, ['class' => 'form-control','required']) !!}
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

        {!! Form::label('pregunta', 'Paciente con Procedimiento?',['style' => 'visibility:visible', 'id'=>'pregunta'])!!}
        <br/>
        <input type="checkbox" name="cosa" value="1" id="cosa" >
        {{ Form::label('radio', 'Si ', ['style' => 'visibility:visible','id' => 'radio']) }}
        <input type="checkbox" name="cosa2" value="2" id="cosa2" >
        {{ Form::label('radio2', 'No ', ['style' => 'visibility:visible','id' => 'radio2']) }}
      <!-- EN EL SELECT VA LA VARIABLE PROCEDIMIENTO -->
        <div class="form-group">
          {!! Form::label('procedimiento_id', 'Procedimiento:',['style' => 'visibility:hidden', 'id' => 'procedimiento'])!!}
          <div class="">
          {!! Form::select('procedimiento_id', $procedimiento, null, ['placeholder' => 'Elija un procedimiento', 'style' => 'visibility:hidden','id' =>'procedimiento_id'])!!}
          </div>
        </div>

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