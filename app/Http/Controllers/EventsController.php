<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Procedimiento;
use App\Events;
use Calendar;
use Validator;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    public function index(){

    	 $events_procedimiento = DB::table('events')->join('procedimientos', 'events.procedimiento_id', '=', 'procedimientos.id')->select('events.event_name' , 'events.start_date', 'events.end_date', 'events.textcolor','procedimientos.nombre', 'procedimientos.color')->get();
    	$procedimiento = Procedimiento::pluck('nombre', 'id')->toArray();
    	

    	return view('events',compact('procedimiento','events_procedimiento'));
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
