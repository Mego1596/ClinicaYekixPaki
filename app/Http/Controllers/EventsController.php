<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Procedimiento;
use App\Events;
use App\Paciente;
use Calendar;
use Validator;

class EventsController extends Controller
{
    public function index(){

    	$procedimiento = Procedimiento::pluck('nombre', 'id')->toArray();

    	$events = Events::select('id','paciente_id','start_date','end_date','procedimiento_id','descripcion')->get();
    	$event_list= [];
    	foreach ($events as $key => $event) {
    		$proceso = Procedimiento::find($event->procedimiento_id);
            $paciente = Paciente::find($event->paciente_id);
    		//poner aqui el paciente asociado a la cita
    		$event_list[] =Calendar::event(
    			$paciente->nombre1." ".$paciente->nombre2." ".$paciente->apellido1." ".$paciente->apellido2,
    			false,
    			new \DateTime($event->start_date),
    			new \DateTime($event->end_date),
    			$event->id,
    			[
    			'color' => $proceso->color,
    			'descripcion' => $event->descripcion,
    			'textColor' => $event->textcolor,
    			'procedimiento' => $proceso->id,
                'durationEditable' => false,
    			]
    		);
    	}
    	
    	

    	$calendar_details = Calendar::addEvents($event_list)->setOptions([
    		'firstDay' => 1,
    		'editable' => true,
    		'themeSystem'=>'bootstrap4',
            'locale' => 'es',
            'defaultView' => 'agendaDay',
    	    'header' => array(
                'left' => 'prev,next today', 
                'center' => 'title', 
                'right' => 'month,agendaWeek,agendaDay'
                )
    		])->setCallbacks([
			'eventClick' => 'function(calEvent,jsEvent,view){
					$("#btnAgregar").hide();
					$("#btnEliminar").hide();
					$("#btnModificar").hide();
				 	$("#txtDescripcion").val(calEvent.descripcion);
				 	$("#txtDescripcion").prop("disabled",true);
				 	$("#txtTitulo").val(calEvent.title);
				 	$("#txtTitulo").prop("disabled",true);
				 	$("#txtID").val(calEvent.id);
				 	$("#txtColor").val(calEvent.color);
				 	FechaHora= calEvent.start._i.split("T");
				 	horaInicio=FechaHora[1].split("+");
				 	FechaHora2= calEvent.end._i.split("T");
				 	horaFin=FechaHora2[1].split("+");
				 	$("#txtFecha").val(FechaHora[0]);
				 	$("#start_date").val(horaInicio[0]);
				 	$("#start_date").prop("disabled",true);
				 	$("#end_date").val(horaFin[0]);
				 	$("#end_date").prop("disabled",true);
				 	$("#procedimiento_id").val(calEvent.procedimiento);
				 	$("#procedimiento_id").prop("disabled",true);
				 	$("#exampleModal").modal(); 	
				 }',

			'eventDrop' => 'function(calEvent,jsEvent,view){
				 	$("#txtID").val(calEvent.id);
				 	$("#txtTitulo").val(calEvent.title);
				 	$("#txtColor").val(calEvent.color);
				 	$("#txtDescripcion").val(calEvent.descripcion);
				 	var fechaHora 	= calEvent.start.format().split("T");
				 	var fechaHora2 	= calEvent.end.format().split("T");
				 	$("#txtFecha").val(fechaHora[0]);
				 	$("#start_date").val(fechaHora[1]);
				 	$("#end_date").val(fechaHora2[1]);
				 	$("#procedimiento_id").val(calEvent.procedimiento);
				 	document.getElementById("btnModificar").click();
				 }',
			]);

    	return view('events',compact('procedimiento','calendar_details'));
    }

    public function addEvent(Request $request){
    	$validator = Validator::make($request->all(), [
    		'paciente_id' 		=> 'required',
    		'start_date' 		=> 'required',
    		'end_date' 			=> 'required',
    		'procedimiento_id' 	=> 'required' 
    	]);

    	if($validator->fails()){
    		\Session::flash('warnning', 'Porfavor ingrese datos validos');
    		return Redirect::to('/events')->withInput()->withErrors($validator);
    	}

    	if (isset($_POST["btnModificar"])) {

    		$event = Events::find($request["txtID"]);
    		$event->start_date			= $request['txtFecha']." ".$request['start_date'];
    		$event->end_date			= $request['txtFecha']." ".$request['end_date'];
    		$event->procedimiento_id 	= $request['procedimiento_id'];
    		$event->save();
    		return Redirect::to('events')->with('info','Cita actualizada con exito');	
    	}
    }
}
