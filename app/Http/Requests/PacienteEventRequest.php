<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events;

class PacienteEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $fechaRequest;
    protected $duracionMaximaCita=181;
    protected $duracionMinimaCita=29;
    protected $requestGeneral;
    public function __construct(Request $request)
    {
        $this->requestGeneral=$request;
        if(strpos($request["txtFecha"], "T")){
            $start_date = str_replace("T", " ", $request['txtFecha']);
            $str = substr($request['txtFecha'],0,-9);
            $this->fechaRequest=$str;
            $x = 0;
        }else{
            $this->fechaRequest=$request['txtFecha'];
            $x = 1;
        }
        /*request emergentes de ayuda a validaciones especiales*/
        $request['RangoLibre']='1';
        $request['RangoStartHora']=Carbon::parse($request['start_date'])->hour."".Carbon::parse($request['start_date'])->format('i');
        $request['RangoEndHora']=Carbon::parse($request['end_date'])->hour."".Carbon::parse($request['end_date'])->format('i');        
        //this allows following the rule in both cases
       
        $request['choques']='1';
      
        $request['minCita']='1';
        $request['maxCita']='1';
        $request['notEqualFree']='1';
        $request['horasFijas']='1';
        $request['notRangoFree']='1';

        
        /***
         * REGLA FUERA DE HORAS DE NEGOCIO
         * 
        /*fuerza que sea fuera de rango si la unica opcion es cero*/
        if($request['RangoStartHora'][0]=='0'){
            $request['RangoStartHora']='2300';
        }


        /*fuerza que sea fuera de rango si la unica opcion es cero*/
        if($request['RangoEndHora'][0]=='0'){
            $request['RangoEndHora']='2300';
        }
        

        /**
         * REGLA HORAS DE ALMUERZO
         */
        
         /*Horarios de almuerzo del negocio*/
        $RangoLibreStartA=Carbon::parse($request['start_date'])->hour."".Carbon::parse($request['start_date'])->format('i');
        $RangoLibreEndA=Carbon::parse($request['end_date'])->hour."".Carbon::parse($request['end_date'])->format('i');

        /*cuando no es sabado*/
        if(Carbon::parse($this->fechaRequest)->format('l')!='Saturday') //if si es sabado
            {  
        if(($RangoLibreEndA > 1200 && $RangoLibreEndA < 1400) ||
         ($RangoLibreStartA > 1200 && $RangoLibreStartA < 1400))
                {
                $request['RangoLibre']='a';//importante determina a-> para dar escapa a integer
                }
                else if($RangoLibreStartA<=1200&&$RangoLibreEndA>=1400){
                $request['notRangoFree']='a';    
                }
            }
            else
            { 
             if(($RangoLibreEndA > 1200 && $RangoLibreEndA < 1300) ||
                ($RangoLibreStartA > 1200 && $RangoLibreStartA < 1300))
                {
               $request['RangoLibre']='a';//importante determina a-> para dar escapa a integer
                }
                else if($RangoLibreStartA<=1200&&$RangoLibreEndA>=1300){
                $request['notRangoFree']='a';
                }
            } 
        /**
         * REGLA NO CITAS A LA HORA 12:00 - 14:00  && 12:00 - 13:00
         */
        if(Carbon::parse($this->fechaRequest)->format('l')!='Saturday'){
            if($RangoLibreEndA==1400&&$RangoLibreStartA==1200){
                    $request['notEqualFree']='a';
                }
        }else{
            if($RangoLibreEndA==1300&&$RangoLibreStartA==1200){
                $request['notEqualFree']='a';
            }
        }

        /***
         * REGLA DE NO CHOQUES DE CITAS
         */
        if($request['reprogramacion'] != 1){

            /*concatena formato concordante a  bd*/
            $fechaHoraInicio=$request['txtFecha']." ".$request['start_date'];
            $fechaHoraFin=$request['txtFecha']." ".$request['end_date'];
            if($x == 0){
                $fechaHoraInicio=$str." ".$request['start_date'];
                $fechaHoraFin=$str." ".$request['end_date'];
            }elseif ($x == 1) {
                $fechaHoraInicio= $request['txtFecha']." ".$request['start_date'];
                $fechaHoraFin= $request['txtFecha']." ".$request['end_date'];
            }

           /*comparacion por ambos lados de rangos existentes */
            $comparacionInferior= Events::where('start_date','>',$fechaHoraInicio)
            ->where('start_date','<',$fechaHoraFin)->get();
            $comparacionSuperior= Events::where('end_date','>',$fechaHoraInicio)
            ->where('end_date','<',$fechaHoraFin)->get();
           /*compara limites inferiores dentro de un mismo dia*/ 
           if(!isset($request['plan'])){ //si esto viene de plan de tratamiento 
           $comparacionExterior=Events::where('start_date','<=',$fechaHoraInicio)
            ->where('end_date','>=',$fechaHoraFin)
            ->where('start_date','>=',$this->fechaRequest.' 00:00:00')
            ->where('end_date','<=',$this->fechaRequest.' 23:59:59')->get();
            }
            else{
                $comparacionExterior=Events::where('start_date','<',$fechaHoraInicio)
                ->where('end_date','>',$fechaHoraFin)
                ->where('start_date','>=',$this->fechaRequest.' 00:00:00')
                ->where('end_date','<=',$this->fechaRequest.' 23:59:59')->get();
            }
            /*si existe un elemento en el array lo fuerza*/
            if(count($comparacionInferior)>0||count($comparacionSuperior)>0){
               
                $request['choques']='a';
            }
            else if(count($comparacionExterior)>0)
            {
            $request['choques']='a'; //fuerza a que sea 'a' para no ser integer 1
            }

        }else{

            $fechaHoraInicio=$request['txtFecha']." ".$request['start_date'];
            $fechaHoraFin=$request['txtFecha']." ".$request['end_date'];
            if($x == 0){
                $fechaHoraInicio=$str." ".$request['start_date'];
                $fechaHoraFin=$str." ".$request['end_date'];
            }elseif ($x == 1) {
                $fechaHoraInicio= $request['txtFecha']." ".$request['start_date'];
                $fechaHoraFin= $request['txtFecha']." ".$request['end_date'];
            }

            /*comparacion por ambos lados de rangos existentes */
                $comparacionInferior= Events::where('start_date','>',$fechaHoraInicio)
                ->where('start_date','<',$fechaHoraFin)->where('reprogramada',false)->get();
                $comparacionSuperior= Events::where('end_date','>',$fechaHoraInicio)
                ->where('end_date','<',$fechaHoraFin)->where('reprogramada',false)->get();
               /*compara limites inferiores dentro de un mismo dia*/ 
                $comparacionExterior=Events::where('start_date','<=',$fechaHoraInicio)
                ->where('end_date','>=',$fechaHoraFin)->where('reprogramada',false)
                ->where('start_date','>=',$this->fechaRequest.' 00:00:00')
                ->where('end_date','<=',$this->fechaRequest.' 23:59:59')->get();

                /*si existe un elemento en el array lo fuerza*/
                if(count($comparacionInferior)>0 || count($comparacionSuperior)>0){
                   
                    $request['choques']='a';
                }
                else if(count($comparacionExterior)>0)
                {
                $request['choques']='a'; //fuerza a que sea 'a' para no ser integer 1
                }
        }

        /**
         * REGLA DURACION DE CITAS
         */
        $horaInicio=Carbon::parse($request['start_date']);
        $horaFin=Carbon::parse($request['end_date']);
        
        if($horaInicio->diffInMinutes($horaFin)<= $this->duracionMinimaCita){
            $request['minCita']='a';
        }
        
        else if($horaInicio->diffInMinutes($horaFin)>= $this->duracionMaximaCita){
            $request['maxCita']='a';            
        }
        $horaInicio=$horaInicio->format('i');
        $horaFin=$horaFin->format('i');

        if(($horaInicio!='00'&&$horaInicio!='30')||($horaFin!='00'&&$horaFin!='30')){
            $request['horasFijas']='a';

        }
        //dd($request);
    }
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if(!isset($this->requestGeneral['btnModificar'])&&!isset($this->requestGeneral['btnEliminar'])){
                if(Carbon::parse($this->fechaRequest)->format('l')!='Saturday') //if si es sabado
                {   
        
                        return [
                            'pacienteID'        => 'required',
                            'txtFecha'=>'after_or_equal:today',
                            'start_date'        => [
                                'required',
                                //'date_format:H:i',
                                'before:end_date',
                                'after_or_equal:08:00',

                            ],
                            'end_date'          => [
                                'required',
                                //'date_format:H:i',
                                'after:start_date',
                                'before_or_equal:18:00',

                                
                            ],
                            'RangoStartHora'=> 'integer|between:800,1800',
                            'RangoEndHora'=> 'integer|between:800,1800',
                            'RangoLibre'=>'integer',
                            'notEqualFree'=>'integer',
                            'choques'=>'integer',
                            'minCita'=>'integer',
                            'maxCita'=>'integer',
                            'horasFijas'=>'integer',
                            'notRangoFree'=>'integer'
                        ];
                }//si es lunes-viernes, domingo
                else{
                        return [
                            'pacienteID'        => 'required',
                            'txtFecha'=>'after_or_equal:today',
                            'start_date'        => [
                                'required',
                                //'date_format:H:i',
                                'before:end_date',
                                'after_or_equal:08:00',

                            ],
                            'end_date'          => [
                                'required',
                                //'date_format:H:i',
                                'after:start_date',
                                'before_or_equal:15:00',

                                
                            ],
                            'RangoStartHora'=> 'integer|between:800,1500',
                            'RangoEndHora'=> 'integer|between:800,1500',
                            'RangoLibre'=>'integer',
                            'notEqualFree'=>'integer',
                            'choques'=>'integer',
                            'minCita'=>'integer',
                            'maxCita'=>'integer',
                            'horasFijas'=>'integer',
                            'notRangoFree'=>'integer'
                        ];
                }//fin por si es sabado
        }
        else//si proviene del boton modificar
        {
            if(Carbon::parse($this->fechaRequest)->format('l')!='Saturday') //if si es sabado
            {   

                    return [
                        'pacienteID'        => 'required',
                        'txtFecha'=>'after_or_equal:today',
                        'start_date'        => [
                            'required',
                            //'date_format:H:i',
                            'before:end_date',
                            'after_or_equal:08:00',

                        ],
                        'end_date'          => [
                            'required',
                            //'date_format:H:i',
                            'after:start_date',
                            'before_or_equal:18:00',

                            
                        ],
                        'RangoStartHora'=> 'integer|between:800,1800',
                        'RangoEndHora'=> 'integer|between:800,1800',
                        'RangoLibre'=>'integer',
                        'notEqualFree'=>'integer',
                        'minCita'=>'integer',
                        'maxCita'=>'integer',
                        'horasFijas'=>'integer',
                        'notRangoFree'=>'integer'
                    ];
            }//si es lunes-viernes, domingo
            else{
                    return [
                        'pacienteID'        => 'required',
                        'txtFecha'=>'after_or_equal:today',
                        'start_date'        => [
                            'required',
                            //'date_format:H:i',
                            'before:end_date',
                            'after_or_equal:08:00',

                        ],
                        'end_date'          => [
                            'required',
                            //'date_format:H:i',
                            'after:start_date',
                            'before_or_equal:15:00',

                            
                        ],
                        'RangoStartHora'=> 'integer|between:800,1500',
                        'RangoEndHora'=> 'integer|between:800,1500',
                        'RangoLibre'=>'integer',
                        'notEqualFree'=>'integer',
                        'minCita'=>'integer',
                        'maxCita'=>'integer',
                        'horasFijas'=>'integer',
                        'notRangoFree'=>'integer'
 
                    ];
            }//fin por si es sabado

        }
    }

    public function messages()
    {
        if(Carbon::parse($this->fechaRequest)->format('l')!='Saturday')
        {  
        return [
        'start_date.required'=>'Hora de fin de cita requerida',
        'start_date.before'=>'La hora de inicio debe ser antes de la hora de fin',
        'start_date.after_or_equal'=>'La hora de atención es despues de las 8:00',
        'end_date:required'=>'Hora de inicio requerida',
        'end_date.before_or_equal'=>'La hora de atencion es antes de las 18:00',
        'end_date.after'=>'La hora de fin debe ser despues de la hora inicio',
        'txtFecha.after_or_equal'=>'La fecha no debe ser dias anteriores a hoy',
   
        'txtFecha.after'=>'La cita no debe ser programada para hoy mismo o dias anteriores',
        'pacienteID.required'=>'campo requerido',
        'RangoStartHora.between'=>'Horarios de atencion dia lunes-viernes,domingo 8:00-18:00',
        'RangoEndHora.between'=>'Horarios de atencion dia lunes-viernes,domingo 8:00-18:00',
        'RangoLibre.integer'=>'No se atiende de 12:00 a 14:00 ',
        'choques.integer'=>'No deben chocar citas con otros pacientes',
        'minCita.integer'=>'Las citas no deben durar menos de 30 minutos',
        'maxCita.integer'=>'Las citas no deben durar mas de 3 horas',
        'notEqualFree.integer'=>'La cita no puede ser de 12:00 a 14:00',
        'horasFijas.integer'=>'Citas deben ser puntuales horas y fracciones de media hora',
        'notRangoFree.integer'=>'No se puede agendar horas que esten dentro del rango de 12:00 a 14:00'
        ];
        }
        else{
            return [
                'start_date.required'=>'Hora de fin de cita requerida',
                'start_date.before'=>'La hora de inicio debe ser antes de la hora de fin',
                'start_date.after_or_equal'=>'La hora de atención es despues de las 8:00',
                'end_date:required'=>'Hora de inicio requerida',
                'end_date.before_or_equal'=>'La hora de atencion es antes de las 15:00 dia sábado',
                'end_date.after'=>'La hora de fin debe ser despues de la hora inicio',
                'txtFecha.after_or_equal'=>'La fecha no debe ser dias anteriores a hoy',
                'txtFecha.after'=>'La cita no debe ser programada para hoy mismo o dias anteriores',
                'pacienteID.required'=>'campo requerido',
                'RangoStartHora.between'=>'Horarios de atencion dia sábado 8:00-15:00',
                'RangoEndHora.between'=>'Horarios de atencion dia sábado 8:00-15:00',
                'RangoLibre.integer'=>'No se atiende de 12:00 a 14:00 ',
                'choques.integer'=>'No deben chocar citas con otros pacientes',
                'minCita.integer'=>'Las citas no deben durar menos de 30 minutos',
                'maxCita.integer'=>'Las citas no deben durar mas de 3 horas',
                'notEqualFree.integer'=>'La cita no puede ser de 12:00 a 13:00',
                'horasFijas.integer'=>'Citas deben ser puntuales horas y fracciones de media hora',
                'notRangoFree.integer'=>'No se puede agendar horas que esten dentro del rango de 12:00 a 13:00'
                ];
        }

    }

}
