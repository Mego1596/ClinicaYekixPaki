<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class listPacienteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $ruta;
    public function __construct(Route $ruta){
        $this->ruta=$ruta;
    }
    public function handle($request, Closure $next)
    {;
       if( Auth::user()->roles[0]->name=="Administrador" ||Auth::user()->roles[0]->name=="Odontologo"||Auth::user()->roles[0]->name=="Asistente"){
        return $next($request);
    }
    else if($this->ruta->paciente->id == (Auth::user()->id)){
        return $next($request);
    }
    else{
        return back();
    }

 

    }
}
