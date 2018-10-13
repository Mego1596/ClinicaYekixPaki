<?php

namespace App\Http\Controllers;

use App\Plan_Tratamiento;
use Illuminate\Http\Request;
use App\Events;
use App\Paciente;
use App\Procedimiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Calendar;
use Validator;
class PlanTratamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id,$validador)
    {
        $citaGeneral = Events::find($id);

        $paciente = Paciente::select('id')->where('id',$citaGeneral->paciente_id)->value('id');
        $persona = Paciente::select('nombre1','nombre2','nombre3','apellido1','apellido2')->where('id',$citaGeneral->paciente_id)->get();
        $planTratamiento = Plan_Tratamiento::select('id','procedimiento_id','completo','en_proceso','no_iniciado','honorarios','no_de_piezas')->where('events_id',$id)->orderBy('id','ASC')->paginate();
        $planValidador = Plan_Tratamiento::select('id')->where('events_id',$id)->where('en_proceso',true)->where('activo',true)->whereNull('procedencia')->get();
        $planValidador2 = Plan_Tratamiento::select('id')->where('events_id',$id)->where('completo',true)->where('activo',true)->whereNull('procedencia')->get();
        $proc = Procedimiento::paginate();

        $presupuesto = Plan_Tratamiento::where('events_id',$id)->sum('honorarios');
        return view('planTratamiento.index',compact('planTratamiento','proc','id','paciente','persona','planValidador','validador','planValidador2','presupuesto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$validador)
    {
        $cita = Events::find($id);
        $procedimiento = Procedimiento::pluck('nombre','id')->toArray();
        return view('planTratamiento.create',compact('id','procedimiento','validador'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $planTratamiento = Plan_Tratamiento::where('events_id',$request->events_id)->get();
        if(sizeof($planTratamiento) <= 0){
            $planT = new Plan_Tratamiento();
            $planT->no_de_piezas        = $request->no_de_piezas;
            $planT->honorarios          = $request->honorarios;
            $planT->procedimiento_id    = $request->procedimiento_id;
            $planT->events_id           = $request->events_id;
            $planT->activo              = true;
            $planT->completo            = false;
            $planT->en_proceso          = true;
            $planT->no_iniciado         = false;
            $planT->save();
        }else{
            $planT = new Plan_Tratamiento();
            $planT->no_de_piezas        = $request->no_de_piezas;
            $planT->honorarios          = $request->honorarios;
            $planT->procedimiento_id    = $request->procedimiento_id;
            $planT->events_id           = $request->events_id;
            $planT->activo              = true;
            $planT->completo            = false;
            $planT->en_proceso          = false;
            $planT->no_iniciado         = true;
            $planT->save();
        }

        return redirect()->route('planTratamiento.index',['cita'=>$request->events_id,'validador'=>$request->validador])->with('info','Procedimiento añadido al plan de tratamiento');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan_Tratamiento  $plan_Tratamiento
     * @return \Illuminate\Http\Response
     */
    public function show(Plan_Tratamiento $plan_Tratamiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan_Tratamiento  $plan_Tratamiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$id2,$validador)
    {
        $plan_trat = Plan_Tratamiento::find($id2);
        return view('planTratamiento.edit', compact('id','plan_trat','validador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan_Tratamiento  $plan_Tratamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $planUpdate = Plan_Tratamiento::find($id);
        $planUpdate->no_de_piezas = $request->no_de_piezas;
        $planUpdate->honorarios   = $request->honorarios;
        $planUpdate->save();
            
        return redirect()->route('planTratamiento.index',['cita' => $request->events_id,'validador'=>$request->validador])
                ->with('info','Procedimiento del plan actualizado con exito');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan_Tratamiento  $plan_Tratamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $plan_Tratamiento = Plan_Tratamiento::find($id);
        $plan_Tratamiento->delete();
        return back()->with('info','Procedimiento eliminado del plan de tratamiento');
    }


    public function agendar2($id2,$id,$paciente,$planActual,$validador)
    {
        $loggedUser=Auth::id();
        $procesos2 = Procedimiento::get();
        $result =  DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('users.id', '=', $loggedUser)->value('role_id');
        if($result == 1 or $result == 3){
            $encendido = true;
        }else{
            $encendido = false;
        }
        $procesos = Procedimiento::where('id',$id)->get();
        $events = Events::select('id','paciente_id','start_date','end_date',/*'procedimiento_id'*/'descripcion')->where('paciente_id',$paciente)->get();
        $event_list= [];
        foreach ($events as $key => $event) {
            $paciente = Paciente::find($event->paciente_id);
            $planT = Plan_Tratamiento::where('events_id',$event->id)->get();
            $validacion = Plan_Tratamiento::select('procedencia')->where('events_id',$event->id)->value('procedencia');
            if(sizeof($planT) > 1 || sizeof($planT) == 0){
                $event_list[] =Calendar::event(
                    $paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1." ".$paciente->apellido2,
                    false,
                    new \DateTime($event->start_date),
                    new \DateTime($event->end_date),
                    $event->id,
                    [
                    /*'color'             => $proceso->color,*/
                    'descripcion'       => $event->descripcion,
                    'textColor'         => $event->textcolor,
                    'durationEditable'  => false,
                    ]
                );
            }elseif (sizeof($planT) == 1 && is_null($validacion)) {
                $event_list[] =Calendar::event(
                    $paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1." ".$paciente->apellido2,
                    false,
                    new \DateTime($event->start_date),
                    new \DateTime($event->end_date),
                    $event->id,
                    [
                    'descripcion'       => $event->descripcion,
                    'textColor'         => $event->textcolor,
                    'durationEditable'  => false,
                    'expediente'        => $paciente->expediente,
                    'paciente'          => $paciente->id,
                    'validador'         => 1,
                    ]
                );
            }else{
                $planT2 = Plan_Tratamiento::where('events_id',$event->id)->value('procedimiento_id');
                $proceso = Procedimiento::find($planT2);
                $event_list[] =Calendar::event(
                    $paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1." ".$paciente->apellido2,
                    false,
                    new \DateTime($event->start_date),
                    new \DateTime($event->end_date),
                    $event->id,
                    [
                    'color'             => $proceso->color,
                    'descripcion'       => $event->descripcion,
                    'textColor'         => $event->textcolor,
                    'durationEditable'  => false,
                    ]
                );
            }
        }
        
        

        $calendar_details = Calendar::addEvents($event_list)->setOptions([
            'firstDay'      => 1,
            'editable'      => false,
            'themeSystem'   => 'bootstrap4',
            'locale'        => 'es',
            'header'        => array(
                        'left' => 'prev,next today', 
                      'center' => 'title', 
                       'right' => 'month,agendaWeek,agendaDay'
            ),

            ])->setCallbacks([
            'dayClick' => 'function(date,jsEvent,view){
                //solo si es admin o asistente puede agregar la cita
                if($("#encendido").val() == 1){
                    $("#btnAgregar").prop("disabled",false);
                    $("#btnEliminar").prop("disabled",true);
                    $("#btnModificar").prop("disabled",true);
                    $("#tit").hide();
                    $("#txtTitulo").hide();
                    limpiarFormulario();
                    $("#txtFecha").val(date.format());
                    var horaInicio=String(date).substring(16,24);
                    if(horaInicio == "00:00:00"){
                    }else{
                           $("#start_date").val(horaInicio);
                    }
                    $("#exampleModal").modal();
                }
            }',


            'eventClick' => 'function(calEvent,jsEvent,view){
                //solo si es admin o asistente puede editar la cita
                if($("#encendido").val() == 1){
                    $("#btnAgregar").prop("disabled",true);
                    $("#btnEliminar").prop("disabled",false);
                    $("#btnModificar").prop("disabled",false);
                    $("#txtDescripcion").val(calEvent.descripcion);
                    $("#txtTitulo").val(calEvent.title);
                    $("#txtID").val(calEvent.id);
                    $("#txtColor").val(calEvent.color);
                    FechaHora= calEvent.start._i.split("T");
                    horaInicio=FechaHora[1].split("-");
                    FechaHora2= calEvent.end._i.split("T");
                    horaFin=FechaHora2[1].split("-");
                    $("#txtFecha").val(FechaHora[0]);
                    $("#start_date").val(horaInicio[0]);
                    $("#end_date").val(horaFin[0]);
                    //$("#procedimiento_id").val(calEvent.procedimiento);
                    $("#exampleModal").modal();     
                }else{
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
                    horaInicio=FechaHora[1].split("-");
                    FechaHora2= calEvent.end._i.split("T");
                    horaFin=FechaHora2[1].split("-");
                    $("#txtFecha").val(FechaHora[0]);
                    $("#start_date").val(horaInicio[0]);
                    $("#start_date").prop("disabled",true);
                    $("#end_date").val(horaFin[0]);
                    $("#end_date").prop("disabled",true);
                    //$("#procedimiento_id").val(calEvent.procedimiento);
                    //$("#procedimiento_id").prop("disabled",true);
                    $("#exampleModal").modal(); 
                }
            }',

            'eventDrop' => 'function(calEvent,jsEvent,view){
                    $("#txtID").val(calEvent.id);
                    $("#txtTitulo").val(calEvent.title);
                    $("#txtColor").val(calEvent.color);
                    $("#txtDescripcion").val(calEvent.descripcion);
                    var fechaHora   = calEvent.start.format().split("T");
                    var fechaHora2  = calEvent.end.format().split("T");
                    $("#txtFecha").val(fechaHora[0]);
                    $("#start_date").val(fechaHora[1]);
                    $("#end_date").val(fechaHora2[1]);
                    //$("#procedimiento_id").val(calEvent.procedimiento);
                    document.getElementById("btnModificar").click();
                 }',

            ]);

        return view('planTratamiento.agenda',compact('procesos','calendar_details','paciente','encendido','id','id2','planActual','validador','procesos2'));
    }

    public function addEvent(Request $request){
        $validator = Validator::make($request->all(), [
            'pacienteID'        => 'required',
            'start_date'        => 'required',
            'end_date'          => 'required',
        ]);
        if($validator->fails()){
            \Session::flash('warnning', 'Porfavor ingrese datos validos');
            return redirect()->route('planTratamiento.agenda',['procedimiento'=>$request['txtProcedimiento_id'], 'paciente' => $request['pacienteID']])->withInput()->withErrors($validator);
        }
        if(isset($_POST["btnAgregar"])){
        $event = new Events();
        $event->paciente_id         = $request['pacienteID'];
        if(strpos($request["txtFecha"], "T")){
            $event->start_date          = str_replace("T", " ", $request['txtFecha']);
            $str = substr($request['txtFecha'],0,-9);
            $event->end_date            = $str." ".$request['end_date'];
        }else{
            $event->start_date          = $request['txtFecha']." ".$request['start_date'];
            $event->end_date            = $request['txtFecha']." ".$request['end_date'];
        }
       // if(!is_null($request['procedimiento_id'])){
       //     $event->procedimiento_id    = $request['procedimiento_id'];
       // }
        $event->descripcion         = $request['txtDescripcion'];
        $event->save();

        $tratamiento_cita = new Plan_Tratamiento();
        $tratamiento_cita->no_de_piezas        = $request->no_de_piezas;
        $tratamiento_cita->honorarios          = $request->honorarios;
        $tratamiento_cita->procedimiento_id    = $request->txtProcedimiento_id;
        $tratamiento_cita->events_id           = $event->id;
        $tratamiento_cita->activo              = false;
        $tratamiento_cita->completo            = false;
        $tratamiento_cita->en_proceso          = false;
        $tratamiento_cita->no_iniciado         = false;
        $tratamiento_cita->procedencia         = 1;
        $tratamiento_cita->referencia          = $request->referencia;
        $tratamiento_cita->save();

        return redirect()->route('planTratamiento.agenda',['procedimiento'=>$request['txtProcedimiento_id'], 'paciente' => $request['pacienteID'],'planTratamiento'=>$request->referencia,'validador'=> $request->txtValidador,'cita' => $request->cita])->with('info','Cita guardada con exito');

        }elseif (isset($_POST["btnModificar"])) {
            $event = Events::find($request["txtID"]);
            $event->paciente_id         = $request['pacienteID'];
            $event->start_date          = $request['txtFecha']." ".$request['start_date'];
            $event->end_date            = $request['txtFecha']." ".$request['end_date'];
            //$event->procedimiento_id    = $request['procedimiento_id'];
            $event->descripcion         = $request['txtDescripcion'];
            $event->save();
            return redirect()->route('planTratamiento.agenda',['procedimiento'=>$request['txtProcedimiento_id'], 'paciente' => $request['pacienteID'],'planTratamiento'=>$request->referencia,'validador'=> $request->txtValidador,'cita' => $request->cita])->with('info','Cita Actualizada con exito');

        }elseif (isset($_POST['btnEliminar'])) {
            $event = Events::find($request["txtID"]);
            $plan = Plan_Tratamiento::where('events_id',$event->id);
            $plan->delete();
            $event->delete();
            return redirect()->route('planTratamiento.agenda',['procedimiento'=>$request['txtProcedimiento_id'], 'paciente' => $request['pacienteID'],'planTratamiento'=>$request->referencia,'validador'=> $request->txtValidador,'cita' => $request->cita])->with('info','Cita Eliminada con exito');

        }

        
    }


    public function terminar($id)
    {
        $planActual = Plan_Tratamiento::find($id);
        $planActual->completo   = true;
        $planActual->en_proceso = false;
        $planActual->save();

        return back()->with('info','Procedimiento Completado');
    }

    public function iniciar($id)
    {
        $planActual = Plan_Tratamiento::find($id);
        $planActual->en_proceso  = true;
        $planActual->no_iniciado = false;
        $planActual->save();
        return back()->with('info','Procedimiento Iniciado');
    }

    public function finalizar($cita)
    {
        $planActual = Plan_Tratamiento::where('events_id',$cita)->get();

        foreach ($planActual as $key => $value) {
            $value->activo          = false;
            $value->completo        = true;
            $value->en_proceso      = false;
            $value->no_iniciado     = false;
            $value->save();
        }

        return back()->with('info','Plan de Tratamiento Finalizado');
    }
}
