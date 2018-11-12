<?php

namespace App\Http\Middleware;

use Closure;
use App\Plan_Tratamiento;
use Illuminate\Http\Request;
use App\Events;

class planTratamientoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   

    public function handle($request, Closure $next, $evento)
    {
   



        if($evento==='events')
        {
            $idTratamiento=$request->route('planTratamiento');
            $tratamiento=Plan_Tratamiento::find($idTratamiento);
            

            $tratamiento==null? abort(404):'';
            //if($tratamiento->comezado)
           // dd($tratamiento->procedimiento_id==$request->route('procedimiento'));
                if(!is_null($tratamiento->referencia)) //crear citas sobre referencias
                {
               $request->session()->flash('error', 'Ruta bloqueada, citas hijas no pueden tener otras citas hijas');
               return back();
                }
                else if(!$tratamiento->comenzado) //fuera de comenzado
                {
                    $request->session()->flash('error', 'Ruta bloqueada, plan no comenzado');
                    return back();
                }

                else if($request->route('procedimiento')!=$tratamiento->procedimiento_id) 
                {
                    $request->session()->flash('error', 'Ruta bloqueada, parece que quieres modificar el procedimiento desde la url');
                    return back();   
                }
                else if($tratamiento->completo){
                    $request->session()->flash('error', "Tratamiento {$tratamiento->id} completado, no hay acceso");
                    return back(); 
                }
                else if(!$tratamiento->activo){
                    $request->session()->flash('error', "Tratamiento {$tratamiento->id} deshabilitado, no hay acceso");
                    return back(); 
                }
                else
                {
                    return $next($request);    
                }

        }//end events.tratamiento conditions
        
        else
        {

            $cita=Events::find($request->route('cita'));
            $cita==null? abort(404):''; //si no existe la cita aborta

            $tratamiento=Plan_Tratamiento::where('events_id',$cita->id)->first();            
            if($tratamiento== null)
             return $next($request);
            
             if(!is_null($tratamiento->referencia)) //crear citas sobre referencias
                {
                $request->session()->flash('error', 'Ruta bloqueada, citas hijas no tienen capacidad de iniciar plan de tratamientos');
                return back();
                }
            else if($tratamiento->completo){
                $request->session()->flash('error', "Tratamiento {$tratamiento->id} completado, no hay acceso");
                return back(); 
            }
            else if(!$tratamiento->activo){
                $request->session()->flash('error', "Tratamiento {$tratamiento->id} deshabilitado, no hay acceso");
                return back(); 
            }
            else
            {
                return $next($request);    
            }

        } //index.plantratamiento conditions
    
    }
}
