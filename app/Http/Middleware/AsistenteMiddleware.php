<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\User;

class AsistenteMiddleware
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

        if(!(Auth::user()->roles[0]->name=="Asistente"))
            return $next($request);
        else if($this->ruta->user->id == User::where('id','=',Auth::user()->id)->first()->id)
            return $next($request);
        else
            return back();
        
            
        }
}
