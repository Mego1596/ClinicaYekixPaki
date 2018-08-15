<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Procedimiento;
use App\Events;
use Calendar;
use Validator;

class EventsController extends Controller
{
    public function index(){

    	$procedimiento = Procedimiento::pluck('nombre', 'id')->toArray();
    	$events = Events::select('id','event_name','start_date','end_date','procedimiento_id','descripcion')->get();
    	$event_list= [];
    	foreach ($events as $key => $event) {
    		$proceso = Procedimiento::find($event->procedimiento_id);
    		//poner aqui el paciente asociado a la cita
    		$event_list[] =Calendar::event(
    			$event->event_name,
    			false,
    			new \DateTime($event->start_date),
    			new \DateTime($event->end_date),
    			$event->id,
    			[
    			'color' => $proceso->color,
    			'descripcion' => $proceso->nombre,
    			'textColor' => $event->textcolor,
    			]
    		);
    	}



    	$calendar_details = Calendar::addEvents($event_list)->setOptions([
    		'firstDay' => 1,
    		'editable' => true,
    		'themeSystem'=>'bootstrap4',
            'locale' => 'es',
    	    'header' => array(
                'left' => 'prev,next today', 
                'center' => 'title', 
                'right' => 'month,agendaWeek,agendaDay'
                )
    		])->setCallbacks([
			'dayClick' => 'function(date,jsEvent,view){
					$("#btnAgregar").prop("disabled",false);
					$("#btnEliminar").prop("disabled",true);
					$("#btnModificar").prop("disabled",true);
					limpiarFormulario();
					$("#txtFecha").val(date.format());
					$("#exampleModal").modal();
				}',
			'eventClick' => 'function(calEvent,jsEvent,view){
				 	$("#btnAgregar").prop("disabled",true);
				 	$("#btnEliminar").prop("disabled",false);
					$("#btnModificar").prop("disabled",false);
				 	$("#txtDescripcion").val(calEvent.descripcion);
				 	$("#txtTitulo").val(calEvent.title);
				 	$("#txtID").val(calEvent.id);
				 	$("#txtColor").val(calEvent.color);
				 	FechaHora= calEvent.start._i.split("T");
				 	horaInicio=FechaHora[1].split("+");
				 	FechaHora2= calEvent.end._i.split("T");
				 	horaFin=FechaHora2[1].split("+");
				 	$("#txtFecha").val(FechaHora[0]);
				 	$("#start_date").val(horaInicio[0]);
				 	$("#end_date").val(horaFin[0]);
				 	$("#exampleModal").modal(); 	
				 }',
			]);

    	return view('events',compact('procedimiento','calendar_details'));
    }

    public function addEvent(Request $request){
    	$validator = Validator::make($request->all(), [
    		'event_name' 		=> 'required',
    		'start_date' 		=> 'required',
    		'end_date' 			=> 'required',
    		'procedimiento_id' 	=>'required' 
    	]);

    	if($validator->fails()){
    		\Session::flash('warnning', 'Porfavor ingrese datos validos');
    		return Redirect::to('/events')->withInput()->withErrors($validator);
    	}

    	$event = new Events();

    	$event->event_name			= $request['event_name'];
    	$event->start_date			= $request['txtFecha']." ".$request['start_date'];
    	$event->end_date			= $request['txtFecha']." ".$request['end_date'];
    	$event->procedimiento_id 	=$request['procedimiento_id'];
    	$event->save();

    	\Session::flash('success','Cita añadida exitosamente');
    	return Redirect::to('events');

    }
}
