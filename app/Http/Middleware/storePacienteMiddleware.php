<?php

namespace App\Http\Middleware;

use Closure;
use App\Paciente;
use App\Events;

class storePacienteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ultimoPaciente = Paciente::max("id");
        $cantidad = Events::where('paciente_id', $ultimoPaciente)->count();
        
        if($cantidad==0)
        {   
            $request->session()->flash('error', "Ruta pacientes create bloqueada hasta que se registre una cita en el ultimo usuario");
            return back();

        }
        else
        {
            return $next($request);
        }
    }
}
