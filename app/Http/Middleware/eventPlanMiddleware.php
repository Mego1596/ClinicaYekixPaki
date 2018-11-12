<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;

class eventPlanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $ruta;
    public function __construct(Route $ruta)
    {
        $this->ruta=$ruta;
    }
    public function handle($request, Closure $next)
    {

        $sql= "SELECT paciente_id,id FROM events WHERE id IN (SELECT events_id FROM plan__tratamientos AS tbl WHERE paciente_id =".$this->ruta->paciente->id." AND id = (SELECT MAX(id) FROM plan__tratamientos WHERE activo = TRUE AND events_id = tbl.events_id))";
       
        $eventos = DB::select(DB::raw($sql));
        $aux = false;
       //recorrido de eventos
        foreach ($eventos as $key => $cita) {
            if ($cita->paciente_id == $this->ruta->paciente->id) {
                $aux = true;
            }else{
                $aux = false;
            }
        }

        //test if it's user id equal to 1 
    
        $verifyGeneralUser= $this->ruta->paciente->id==1? true: false; 

        $user= Auth::user();


        if($user->roles[0]->name!='Paciente')
        {
            if($aux && !$verifyGeneralUser)
            {
                $request->session()->flash('error', "Ruta bloqueada, existe plan habilitado, se retorna a la ultima ruta conocida");
                return back();
            }
            else
            {
                return $next($request);
            }
        }
        else
        {
            return $next($request);
        }
    }
}
