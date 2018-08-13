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
				<div class="container">
					<div class="row">
						<div>
								<div id="calendar"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection


@section('calendar')
	<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here

             events : [
                @foreach($events_procedimiento as $task)
                {	
                	
                    title 		: '{{ $task->event_name }}',
                    start 		: '{{ $task->start_date }}',
             		end   		: '{{ $task->end_date}}',
             		textColor	: '{{ $task->textcolor}}',
             		color 		: '{{ $task->color}}',
                },
                @endforeach
            ]
        })
    });
</script>
@endsection