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
    	$events = Events::get();
    	$event_list= [];
    	foreach ($events as $key => $event) {
    		$proceso = Procedimiento::find($event->procedimiento_id);
    		var_dump($proceso);
    		$event_list[] =Calendar::event(
    			$event->event_name,
    			false,
    			new \DateTime($event->start_date),
    			new \DateTime($event->end_date.' +1 day'),
    			null,
    			[
    			'color' => $proceso->color,
    			'description' => $proceso->nombre,
    			'textColor' => $event->textcolor,
    			]
    		);
    	}


    	$calendar_details = Calendar::addEvents($event_list)->setOptions(['firstDay' => 7, 'editable' => true, 'eventLimit' => true, 'header' => array('left' => 'prev,next today', 'center' => 'title', 'right' => 'month,basicWeek,basicDay')])->setCallbacks([
    		'eventClick' => 'function(calEvent, jsEvent, view) {
       			$("#modalTitle").html(calEvent.title);
          		$("#modalBody").html(calEvent.description);
          		$("#eventUrl").attr("href",calEvent.linkurl);
          		$("#fullCalModal").modal();
   }']);

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
    	$event->start_date			= $request['start_date'];
    	$event->end_date			= $request['end_date'];
    	$event->procedimiento_id 	=$request['procedimiento_id'];
    	$event->save();

    	\Session::flash('success','Cita añadida exitosamente');
    	return Redirect::to('events');
    }
}
