<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Procedimiento;
use App\Events;
use App\Paciente;
use App\Plan_Tratamiento;
use App\Pago;
use Calendar;
use Validator;

class EventsController extends Controller
{
    public function index(){
        $loggedUser=Auth::id();
        $result =  DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('users.id', '=', $loggedUser)->value('role_id');
        if($result == 1 or $result == 3){
            $encendido = true;
        }else{
            $encendido = false;
        }
    	//$procedimiento = Procedimiento::pluck('nombre', 'id')->toArray();
        $procesos = Procedimiento::paginate(100);
    	$events = Events::select('id','paciente_id','start_date','end_date','descripcion','reprogramada')->get();
        $event_list= [];
        foreach ($events as $key => $event) {
            $paciente = Paciente::find($event->paciente_id);
            $planT = Plan_Tratamiento::where('events_id',$event->id)->get();
            $validacion = Plan_Tratamiento::select('procedencia')->where('events_id',$event->id)->value('procedencia');

            //OBTENIENDO PACIENTES CON UN PLAN DE TRATAMIENTO ACTIVO PARA RESTRINGIR TODAS LAS
            //POSTERIORES BLOQUEADAS PARA REALIZAR UN PLAN DE TRATAMIENTO

            $string = "SELECT paciente_id,id FROM events WHERE paciente_id=".$paciente->id." AND id IN (SELECT events_id FROM plan__tratamientos AS tbl
                WHERE id = (SELECT MAX(id) FROM plan__tratamientos WHERE plan_valido = TRUE AND activo = TRUE AND events_id = tbl.events_id));";
            $eventos = DB::select(DB::raw($string));
            $planvigente='negativo';
            foreach ($eventos as $key => $cita) {
                if ($cita->paciente_id == $paciente->id) {
                    $planvigente = 'positivo';
                }else{
                    $planvigente = 'negativo';
                }
            }
            //RESTRICCION DE PAGOS PARA PERSONAS QUE TENGAN EL PAGO DEL PLAN DE TRATAMIENTO
            //PAGADO EN SU TOTALIDAD
            $string = "SELECT id FROM events WHERE paciente_id=".$event->paciente_id." AND id IN (SELECT events_id FROM plan__tratamientos AS tbl
                WHERE id = (SELECT MAX(id) FROM plan__tratamientos WHERE plan_valido = TRUE AND activo = TRUE AND events_id = tbl.events_id));";
            $citaPlanPersonal = DB::select(DB::raw($string));

            foreach ($citaPlanPersonal as $key => $value) {
               $cita = $value->id;
            }

            $x =0.0;
            $getPagoAdd = Pago::select('abono')->where('events_id',$cita)->get('abono');
            if (sizeof($getPagoAdd) == 0) {
                    $x = 0.0;
            }else{
                foreach ($getPagoAdd as $key => $pagoPlan) {
                    $x+= $pagoPlan->abono;
                }
            }
            $planActivoPersonal = Plan_Tratamiento::where('events_id', $cita)->get();
            $planAll            = Plan_Tratamiento::get();
            
            $y=0.0;
            foreach ($planActivoPersonal as $key => $value) {
                $y += $value->honorarios;
            }

            foreach ($planActivoPersonal as $key => $value) {
                if($value->id != 1){
                    foreach ($planAll as $key => $planes1) {
                        if($value->id == $planes1->referencia){
                            $pagoAuxiliar = Pago::select('abono')->where('events_id',$planes1->events_id)->value('abono');
                            $x+= $pagoAuxiliar;
                        }
                    }
                }
            }
            //SI LOS ABONOS DE TODO EL PLAN DE TRATAMIENTO ES IGUAL AL TOTAL DE HONORARIOS EN EL PLAN DE TRATAMIENTO SE DICE QUE SE ESTA PAGADO TOTALMENTE EL PLAN DE TRATAMIENTO DE LO CONTRARIO ES NECESARIO UN PAGO PARA UNA CITA.
            if($x == $y){
                $solvente = 'si';
            }else{
                $solvente = 'no';
            }

            //SI LA CITA ESTA REPROGRAMADA FORZAR SOLVENCIA PARA ESA CITA Y NO SE PUEDE VOLVER A REPROGRAMAR
            if($event->reprogramada == true){
                $solvente = 'si';
                $repro    = 'no';
            }else{
                $repro    = 'si';
            }

            $pagoGratis = Pago::where('events_id',$event->id)->get();
            $restriccion=1;
            if(sizeof($pagoGratis) != 0){
                foreach ($pagoGratis as $key => $value) {
                   if($value->reprogramado == true){
                        $restriccion = 1;
                   }

                   if($value->gratis == true){
                        $restriccion = 0;
                   }

                   if($value->gratis == false && $value->reprogramado == false){
                        $restriccion = 0;
                   }
                }
            }else{
                $restriccion = 0;
            }
            if(sizeof($planT) > 1 || sizeof($planT) == 0){
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
                    'estado'            => $planvigente,
                    'tipo'              => 2,
                    'reprogramar'       => 'no',
                    'idReprogramar'     => 0,
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
                    'estado'            => $planvigente,
                    'tipo'              => 2,
                    'reprogramar'       => 'no',
                    'idReprogramar'     => 0,
                    ]
                );
            }else{
                $planT = Plan_Tratamiento::where('events_id',$event->id)->value('procedimiento_id');
                $proceso = Procedimiento::where('id',$planT)->value('color');
                $procesoNombre = Procedimiento::where('id',$planT)->value('nombre');
                $planAuxiliar = Plan_Tratamiento::where('events_id', $event->id)->value('procedencia');
                if(!is_null($planAuxiliar)){
                    $val = 1;
                }else{
                    $val = 0;
                }
                $event_list[] =Calendar::event(
                    $paciente->nombre1." ".$paciente->nombre2." ".$paciente->nombre3." ".$paciente->apellido1." ".$paciente->apellido2,
                    false,
                    new \DateTime($event->start_date),
                    new \DateTime($event->end_date),
                    $event->id,
                    [
                    'color'             => $proceso,
                    'procedimiento'     => $procesoNombre,
                    'descripcion'       => $event->descripcion,
                    'textColor'         => $event->textcolor,
                    'durationEditable'  => false,
                    'expediente'        => $paciente->expediente,
                    'paciente'          => $paciente->id,
                    'validador'         => $val,
                    'tipo'              => 1,
                    'pago'              => 'si',
                    'estado'            => $planvigente,
                    'solvente'          => $solvente,
                    'reprogramar'       => $repro,
                    'idReprogramar'     => 1,
                    'validar'           => $restriccion,
                    ]
                );
            }
        }
    	

    	$calendar_details = Calendar::addEvents($event_list)->setOptions([
    		'firstDay' => 1,
    		'editable' => false,
    		'themeSystem'=>'bootstrap4',
            'locale' => 'es',
            'defaultView' => 'month',
    	    'header' => array(
                'left' => 'prev,next today', 
                'center' => 'title', 
                'right' => 'month,agendaWeek,agendaDay'
                )
    		])->setCallbacks([
            'dayClick'   => 'function(calEvent,jsEvent,view){
                document.getElementById("cupos").click();
            }',
			'eventClick' => 'function(calEvent,jsEvent,view){
					$("#btnAgregar").hide();
					$("#btnEliminar").hide();
					$("#btnModificar").hide();
				 	$("#txtDescripcion").val(calEvent.descripcion);
				 	$("#txtDescripcion").prop("disabled",true);
				 	$("#txtTitulo").val(calEvent.title);
				 	$("#txtTitulo").prop("disabled",true);
				 	$("#txtID").val(calEvent.id);
                    $("#txtPaciente_id").val(calEvent.paciente);
                    $("#txtValidador").val(calEvent.validador);
                    $("#txtProcedimiento").val(calEvent.procedimiento);
                    if(calEvent.paciente == 1){
                        $("#plan").hide();
                        $("#receta").hide();
                        $("#modificar").hide();
                        $("#pago").hide();
                        $("#btnAsignar").show();
                    }else{
                        $("#plan").hide();
                        $("#modificar").hide();
                        $("#pago").hide();
                        $("#reprogramacion").hide();
                        $("#receta").hide();
                        if(calEvent.validador == 1 && calEvent.estado == "negativo" && calEvent.tipo == 2){
                            $("#plan").show();
                            $("#modificar").show();
                            $("#receta").show();
                        }
                        if(calEvent.validador == 1 && calEvent.estado == "negativo" && calEvent.tipo == 1){
                            $("#plan").show();
                        }
                        if(calEvent.pago == "si"){
                            $("#pago").show();
                        }
                        if(calEvent.reprogramar == "si"){
                            $("#reprogramacion").show();
                            $("#receta").show();
                        }
                        if(calEvent.solvente == "si"){
                            $("#txtSolvencia").val("Plan de Tratamiento pagado totalmente");
                        }else{
                            $("#txtSolvencia").val("Plan de Tratamiento pagado parcialmente o sin pagar");
                        }
                        if(calEvent.idReprogramar == 0){
                            $("#txtSolvencia").val("No Aplica");
                        }
                        if(calEvent.solvente == "si" && calEvent.reprogramar == "no"){
                            $("#txtSolvencia").val("Cita Reprogramada");
                        }
                        if(calEvent.reprogramar == "no" && calEvent.idReprogramar == 0){
                            $("#reprogramacion").hide();
                            $("#receta").show();
                        }
                        if(calEvent.reprogramar == "si" && calEvent.idReprogramar == 1){
                            $("#reprogramacion").show();
                        }else{
                            $("#reprogramacion").hide();
                        }

                        if(calEvent.validar == 1){
                            $("#reprogramacion").hide();
                        }
                        $("#btnAsignar").hide();   
                    }
				 	$("#txtColor").val(calEvent.color);
                    $("#txtExpediente").val(calEvent.expediente);
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
				 }',
			]);

    	return view('events',compact('procesos','calendar_details','loggedUser'));
    }

    public function addEvent(Request $request){
    	$validator = Validator::make($request->all(), [
    		'paciente_id' 		=> 'required',
    		'start_date' 		=> 'required',
    		'end_date' 			=> 'required',
    	]);


    	if($validator->fails()){
            /*
    		\Session::flash('warnning', 'Porfavor ingrese datos validos');
    		return Redirect::to('/events')->withInput()->withErrors($validator);*/
    	}

        if(isset($_POST['btnAsignar'])){
            $event = Events::find($request["txtID"]);
            $pacienteNuevo = Paciente::select('id')->max('id');
            $event->paciente_id = $pacienteNuevo;
            $event->save();
        }
        return redirect()->route('events.index')->with('info','Cita asignada con exito');
    }

    public function reprogramarCita($cita){
        
        $citaActual = Events::where('id',$cita)->get();
        $planActual = Plan_Tratamiento::where('events_id', $cita)->get();
        $procedimientoPlan = Plan_Tratamiento::where('events_id', $cita)->value('procedimiento_id');
        foreach ($planActual as $key => $value) {
            $value->plan_valido = false;
            if($value->activo){
                $value->activo = false;
            }
            $value->save();
        }
        foreach ($citaActual as $key => $value1) {
            $value1->descripcion = $value1->descripcion."\nReprogramada";
            $value1->reprogramada = true;
            $value1->save();
        }
        $pagoGratis = Pago::where('events_id',$cita)->get();

            if(sizeof($pagoGratis) != 1){
            $pagoReprogramar = new Pago();

            $pagoReprogramar->abono = 0.0;

            //CREACION DE CAMPO SALDO PARA CITAS REPROGRAMADAS (REPETIR EL SALDO ANTERIOR)
            $reconocimiento = Plan_Tratamiento::select('referencia')->where('events_id',$cita)->value('referencia');
            if(!is_null($reconocimiento)){
                 $string = "SELECT referencia FROM plan__tratamientos AS tbl WHERE id = (SELECT MAX(id) FROM plan__tratamientos WHERE referencia IS NOT NULL AND events_id = ".$cita.");";
                $plan = DB::select(DB::raw($string));
                $ref;
                foreach ($plan as $key => $value) {
                    $ref = $value->referencia;
                }


                $planPertenece = Plan_Tratamiento::select('events_id')->where('id', $ref)->value('events_id');
                $planT = Plan_Tratamiento::where('events_id',$planPertenece)->get();
                $verificarPago = Pago::select('id')->where('events_id',$planPertenece)->get();
                $pago = Pago::select('abono')->where('events_id',$planPertenece)->value('abono');
                $y=0.0;
                foreach($planT as $planDetalle){
                    $y+=($planDetalle->honorarios);
                }

                if(sizeof($verificarPago) == 0){
                }else{
                    $y-=$pago;
                }
                var_dump($y);
                $planVigente = Plan_Tratamiento::where('events_id', $planPertenece)->get();
                $planes = Plan_Tratamiento::get();
                
                $x=0.0;
                foreach ($planes as $key => $plan1) {
                    foreach ($planVigente as $key => $plan2) {
                        if($plan1->referencia == $plan2->id){
                            $pagoAuxiliar = Pago::select('abono')->where('events_id',$plan1->events_id)->value('abono');
                            $x += $pagoAuxiliar;
                        }
                    }
                }

                $totalAbonos =$x+$pagoReprogramar->abono;

                if($x != 0){
                    if($y != $totalAbonos){
                        $pagoReprogramar->saldo   = $y-$x-$pagoReprogramar->abono;
                    }else{
                        $pagoReprogramar->saldo   = 0.0;
                    }
                }else{
                    if($y != $totalAbonos){
                        $pagoReprogramar->saldo   = $y-$pagoReprogramar->abono;
                    }else{
                        $pagoReprogramar->saldo   = 0.0;
                    }
                }
            }

            $pagoReprogramar->realizoTto        = '-';
            $pagoReprogramar->events_id         = $cita;
            $pagoReprogramar->reprogramado      = true;
            $pagoReprogramar->gratis            =false;
            $pagoReprogramar->save();
        }else{
            foreach ($pagoGratis as $key => $pagoGratis1) {
                $pagoGratis1->descripcion = $pagoGratis1->descripcion."\nReprogramada";
            }
            
        }
        return redirect()->route('home')->with('info','Cita invalidada con exito, proceda a asignar la nueva cita en el plan de tratamiento activo del paciente');
    }
}
