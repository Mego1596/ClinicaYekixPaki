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
                <a href="/home" class="btn btn-block btn-secondary">
                Atrás</a>
              </div>
              <div class="col-md-10">
                <h3 align="center">Citas:</h3>
              </div>
          </div>
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
              <a class="btn btn-info" href="#" name="plan" id="plan">Gestionar Plan de Tratamiento</a>
          </div>
        </div>
        @endcan
        @can('recetas.index')
        <div class="row">
          <div class="col-md-4" style="margin-top: 10px">
              <a class="btn btn-info" href="#" name="receta" id="receta">Gestionar Receta</a>
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
        document.getElementById("receta").onclick = function() {
          var x=parseInt($('#txtID').val());
          this.setAttribute("href","receta/"+x);
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