<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Anexo;
use App\Odontograma;
use App\Paciente;
use App\Plan_Tratamiento;
use App\TipoAnexo;

class OdontogramaController extends Controller
{
    
    public function create(Plan_Tratamiento $planTratamiento, $validador)
    {

        $odontogramas = [];
        $pacienteTieneOdontogramas = false;

        $paciente = $planTratamiento->event->paciente;
        $planes = $paciente->getPlanesTratamiento();

        foreach($planes as $plan){
            $pacienteTieneOdontogramas = (sizeof($plan->odontogramas) > 0) ? true : false;
            if($pacienteTieneOdontogramas) break;
        }

        if($pacienteTieneOdontogramas) {
            if(sizeof($planTratamiento->odontogramas))
                $odontogramas = $planTratamiento->odontogramas;
            else{
                $contador = 1;
                foreach($planes as $plan){
                    if(sizeof($plan->odontogramas)){
                        if(!$contador) $contador++;
                        else{
                            $odontogramas = $plan->odontogramas;
                        }
                    }
                }
            }
        }

        $puedeCrearOdontograma = (sizeof($planTratamiento->odontogramas)) ? false : true;

        return view('odontograma.index')->with('planTratamiento', $planTratamiento)->with('odontogramas', $odontogramas)->with('validador', $validador)->with('puedeCrearOdontograma', $puedeCrearOdontograma);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Plan_Tratamiento $planTratamiento, $validador)
    {
        $paciente = $planTratamiento->event->paciente;
        
        $pacienteTieneOdontogramas = false;

        $planes = $paciente->getPlanesTratamiento();

        foreach($planes as $plan){
            $pacienteTieneOdontogramas = (sizeof($plan->odontogramas) > 0) ? true : false;
            if($pacienteTieneOdontogramas) break;
        }

        DB::transaction(function() use ($request, $planTratamiento, $pacienteTieneOdontogramas, $planes) {
            $odontogramaAnteriorEncontrado = false;

            if($pacienteTieneOdontogramas) {
                foreach(array_reverse($planes) as $plan){
                    if(sizeof($plan->odontogramas)){
                        foreach($plan->odontogramas as $i => $odonto) {
                            if(sizeof($plan->odontogramas) == 1) $i++;
                            if($i){
                                $planTratamiento->odontogramas()->attach($odonto->id, ['es_inicial' => true]);
                                $odontogramaAnteriorEncontrado = true;
                                break;
                            }
                        }
                        if($odontogramaAnteriorEncontrado) break;
                    }
                }
            }

            $odontograma = new Odontograma();
            $odontograma->data = $request->imagen;
            $odontograma->save();

            $planTratamiento->odontogramas()->attach($odontograma->id, ['es_inicial' => false]);

        });

        return redirect()
                    ->route('odontograma.create', [$planTratamiento, $validador])
                    ->with('info','Odontograma guardado con exito')
                    ->with('tipo', 'success');
   
    }

}
