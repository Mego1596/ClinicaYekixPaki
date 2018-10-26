<?php

namespace App\Http\Controllers;

use App\Pago;
use App\Plan_Tratamiento;
use App\Procedimiento;
use App\Events;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
        $pagos = Pago::where('events_id', $id)->paginate();
        $abonoValidar = Pago::select('abono')->where('events_id', $id)->value('abono');
        if($abonoValidar == null){
            $abonoValidar= -1;
        }
        $planT = Plan_Tratamiento::where('events_id',$id)->value('procedimiento_id');
        $procesoNombre = Procedimiento::where('id',$planT)->value('nombre');
        //OBTENIENDO EL SALDO PENDIENTE DEL PLAN DE TRATAMIENTO
        $plan = Plan_Tratamiento::where('events_id',$id)->whereNull('referencia')->get();
        $saldo = 0.0;
        if(sizeof($plan)!=0){
            $pagos3 = Pago::where('events_id', $id)->get();
            if(sizeof($pagos3) != 0){
                foreach ($pagos3 as $key => $value) {
                    $saldo = (double) $value->saldo;
                }
            }else{
                foreach ($plan as $key => $value) {
                    $saldo += $value->honorarios;
                }

            }
            $planActual = Plan_Tratamiento::where('events_id',$id)->get();
            $planAll    = Plan_Tratamiento::get();
            foreach ($planActual as $key => $value) {
                foreach ($planAll as $key => $value1) {
                    if($value->id == $value1->referencia){
                        $pagos2 = Pago::where('events_id', $value1->events_id)->get();
                        if(sizeof($pagos2) != 0){
                            foreach ($pagos2 as $key => $value3) {
                                $saldo = (double) $value3->saldo;
                            }
                        }else{
                            $saldo += (double) $value->honorarios;
                        }
                    }
                }
            }

        }

        $planPadre = Plan_Tratamiento::select('referencia')->where('events_id', $id)->value('referencia');
        $citaPlan = Plan_Tratamiento::select('events_id')->where('id', $planPadre)->value('events_id');
        $planT = Plan_Tratamiento::select('honorarios')->where('events_id', $planPadre)->get();
        $pagos1 = Pago::where('events_id', $citaPlan)->get();
        if(sizeof($pagos1) != 0){
            foreach ($pagos1 as $key => $value) {
                $saldo = (double) $value->saldo;
            }
        }else{
            foreach ($planT as $key => $value) {
                $saldo += (double) $value->honorarios;
            }
        }


        $planActual = Plan_Tratamiento::where('events_id',$citaPlan)->get();
        $planAll    = Plan_Tratamiento::get();
        foreach ($planActual as $key => $value) {
            foreach ($planAll as $key => $value1) {
                if($value->id == $value1->referencia){
                    $pagos2 = Pago::where('events_id', $value1->events_id)->get();
                    if(sizeof($pagos2) != 0){
                        foreach ($pagos2 as $key => $value3) {
                            $saldo = (double) $value3->saldo;
                        }
                    }else{
                        $saldo += (double) $value1->honorarios;
                    }
                }
            }
        }

        return view('pago.index',compact('pagos','procesoNombre','id','idPaciente','saldo','abonoValidar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)->orWhere('role_user.role_id', '=', 1)->select('users.id' , 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->orderBy('id')->paginate();

        return view('pago.create',compact('id','users','idPaciente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $nuevoPago = new Pago();
        $nuevoPago->events_id   = $request->cita;
        $nuevoPago->abono       = $request->abono;
        $nuevoPago->proximaCita = $request->proximaCita;
        $user = User::where('id',$request->realizoTto)->get();
        foreach ($user as $key => $value) {
            $nuevoPago->realizoTto  = $value->nombre1.' '.$value->nombre2.' '.$value->nombre3.' '.$value->apellido1.' '.$value->apellido2.'- '.$value->numeroJunta;
        }

        //Creacion del campo Saldo hasta ese pago para un plan activo
        $reconocimiento = Plan_Tratamiento::select('referencia')->where('events_id',$request->cita)->value('referencia');
        if(!is_null($reconocimiento)){
            $string = "SELECT referencia FROM plan__tratamientos AS tbl WHERE id = (SELECT MAX(id) FROM plan__tratamientos WHERE referencia IS NOT NULL AND events_id = ".$request->cita.");";
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

            $totalAbonos =$x+$request->abono;

            if($x != 0){
                if($y != $totalAbonos){
                    $nuevoPago->saldo   = $y-$x-$request->abono;
                    $nuevoPago->save();
                }else{
                    $nuevoPago->saldo   = 0.0;
                    $nuevoPago->save();
                }
            }else{
                if($y != $totalAbonos){
                    $nuevoPago->saldo   = $y-$request->abono;
                    $nuevoPago->save();
                }else{
                    $nuevoPago->saldo   = 0.0;
                    $nuevoPago->save();
                }
            }



        }else{

            $string = "SELECT id,honorarios FROM plan__tratamientos AS tbl WHERE id = (SELECT MAX(id) FROM plan__tratamientos WHERE referencia IS NULL AND events_id =".$request->cita." AND procedencia = 1);";
            $plan = DB::select(DB::raw($string));

            $nuevoPago = new Pago();

            $nuevoPago->events_id   = $request->cita;
            $nuevoPago->abono       = $request->abono;
            $user = User::where('id',$request->realizoTto)->get();
            foreach ($user as $key => $value) {
                $nuevoPago->realizoTto  = $value->nombre1.' '.$value->nombre2.' '.$value->nombre3.' '.$value->apellido1.' '.$value->apellido2.'- '.$value->numeroJunta;
            }
            

            //Creacion del campo Saldo hasta ese pago para un plan activo
            foreach ($plan as $key => $value) {
                $nuevoPago->saldo = $value->honorarios-$request->abono;
            }

            $nuevoPago->save();
        }


        return redirect()->route('pago.index',['cita' => $request->cita])
                ->with('info','Pago asignado con exito')
                ->with('tipo', 'success');
    }

    public function edit(Pago $pago)
    {
        $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)->orWhere('role_user.role_id', '=', 1)->select('users.id' , 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->orderBy('id')->paginate();
        return view('pago.edit')->with('pago', $pago)->with('users', $users);
    }

    public function update(Request $request, Pago $pago)
    {
        $tipoMensaje = "info";
        $mensaje = "El pago ha sido modificado correctamente";
        if($request->realizoTto){
            $user = User::where('id',$request->realizoTto)->get();
            foreach ($user as $key => $value) {
                $pago->realizoTto  = $value->nombre1.' '.$value->nombre2.' '.$value->nombre3.' '.$value->apellido1.' '.$value->apellido2.'- '.$value->numeroJunta;
            }
            $pago->update();
        }else {
            $tipoMensaje = "error";
            $mensaje = "Debe de seleccionar un Médico en el pago";
        }

        return redirect()->route('pago.index',['cita' => $pago->events_id])
               ->with($tipoMensaje, $mensaje);
    }
}
