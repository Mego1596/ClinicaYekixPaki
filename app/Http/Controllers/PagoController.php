<?php

namespace App\Http\Controllers;

use App\Pago;
use App\Plan_Tratamiento;
use App\Procedimiento;
use App\Events;
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
        $planT = Plan_Tratamiento::where('events_id',$id)->value('procedimiento_id');
        $procesoNombre = Procedimiento::where('id',$planT)->value('nombre');

        return view('pago.index',compact('pagos','procesoNombre','id','idPaciente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)->orWhere('role_user.role_id', '=', 1)->select('users.id' , 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();

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

        //Creacion del campo Saldo hasta ese pago para un plan activo
        $reconocimiento = Plan_Tratamiento::select('referencia')->where('events_id',$request->cita)->get();
        if(!is_null($reconocimiento)){
            $string = "SELECT referencia FROM plan__tratamientos AS tbl WHERE id = (SELECT MAX(id) FROM plan__tratamientos WHERE referencia IS NOT NULL AND events_id = ".$request->cita.");";
            $plan = DB::select(DB::raw($string));
            $ref;
            foreach ($plan as $key => $value) {
                $ref = $value->referencia;
            }

            $planPertenece = Plan_Tratamiento::select('events_id')->where('id', $ref)->value('events_id');
            $planT = Plan_Tratamiento::where('events_id',$planPertenece)->get();
            $y=0.0;
            foreach($planT as $planDetalle){
                $y+=$planDetalle->honorarios;
            }

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
            
        }


        return redirect()->route('pago.index',$request->cita)
                ->with('info','Pago asignado con exito')
                ->with('tipo', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
