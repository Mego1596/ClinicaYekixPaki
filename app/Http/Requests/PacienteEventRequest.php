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
    protected $duracionMaximaCita=180;
    protected $duracionMinimaCita=29;
    protected $requestGeneral;
    public function __construct(Request $request)
    {
        $this->requestGeneral=$request;
        $this->fechaRequest=$request['txtFecha'];   

        /*request emergentes de ayuda a validaciones especiales*/
        $request['RangoLibre']='1';
        $request['RangoStartHora']=Carbon::parse($request['start_date'])->hour."".Carbon::parse($request['start_date'])->format('i');
        $request['RangoEndHora']=Carbon::parse($request['end_date'])->hour."".Carbon::parse($request['end_date'])->format('i');        
        $request['choques']='1';
        $request['minCita']='1';
        $request['maxCita']='1';


        /*fuerza que sea fuera de rango si la unica opcion es cero*/
        if($request['RangoStartHora'][0]=='0'){
            $request['RangoStartHora']='2300';
        }


        /*fuerza que sea fuera de rango si la unica opcion es cero*/
        if($request['RangoEndHora'][0]=='0'){
            $request['RangoEndHora']='2300';
        }

        /*Horarios de almuerzo del negocio*/
        $RangoLibreStartA=Carbon::parse($request['start_date'])->hour."".Carbon::parse($request['start_date'])->format('i');
        $RangoLibreEndA=Carbon::parse($request['end_date'])->hour."".Carbon::parse($request['end_date'])->format('i');
       
        if(($RangoLibreEndA > 1200 && $RangoLibreEndA < 1400) ||
         ($RangoLibreStartA > 1200 && $RangoLibreStartA < 1400)){
            $request['RangoLibre']='a';//importante determina a-> para dar escapa a integer
        }   
        /*revisa si existe un registro intermedio establecido*/
       
        /*concatena formato concordante a  bd*/
        $fechaHoraInicio=$request['txtFecha']." ".$request['start_date'];
        $fechaHoraFin=$request['txtFecha']." ".$request['end_date'];
       /*comparacion por ambos lados de rangos existentes */
        $comparacionInferior= Events::where('start_date','>=',$fechaHoraInicio)->where('start_date','<=',$fechaHoraFin)->get();
        $comparacionSuperior= Events::where('end_date','>=',$fechaHoraInicio)->where('end_date','<=',$fechaHoraFin)->get();
       
        /*si existe un elemento en el array lo fuerza*/
        if(count($comparacionInferior)>0||count($comparacionSuperior)>0){
            $request['choques']='a'; //fuerza a que sea 'a' para no ser integer 1
        }

        $horaInicio=Carbon::parse($request['start_date']);
        $horaFin=Carbon::parse($request['end_date']);
        
        if($horaInicio->diffInMinutes($horaFin)<= $this->duracionMinimaCita){
            $request['minCita']='a';
        }
        
        else if($horaInicio->diffInMinutes($horaFin)>= $this->duracionMaximaCita){
            $request['maxCita']='a';            
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
                            'txtFecha'=>'after:today',
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
                            'choques'=>'integer',
                            'minCita'=>'integer',
                            'maxCita'=>'integer'
                        ];
                }//si es lunes-viernes, domingo
                else{
                        return [
                            'pacienteID'        => 'required',
                            'txtFecha'=>'after:today',
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
                            'choques'=>'integer',
                            'minCita'=>'integer',
                            'maxCita'=>'integer'
                        ];
                }//fin por si es sabado
        }
        else//si proviene del boton modificar
        {
            if(Carbon::parse($this->fechaRequest)->format('l')!='Saturday') //if si es sabado
            {   

                    return [
                        'pacienteID'        => 'required',
                        'txtFecha'=>'after:today',
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
                        'minCita'=>'integer',
                        'maxCita'=>'integer'
                    ];
            }//si es lunes-viernes, domingo
            else{
                    return [
                        'pacienteID'        => 'required',
                        'txtFecha'=>'after:today',
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
                        'minCita'=>'integer',
                        'maxCita'=>'integer'
 
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
   
        'txtFecha.after'=>'La cita no debe ser programada para hoy mismo o dias anteriores',
        'pacienteID.required'=>'campo requerido',
        'RangoStartHora.between'=>'Horarios de atencion dia lunes-viernes,domingo 8:00-18:00',
        'RangoEndHora.between'=>'Horarios de atencion dia lunes-viernes,domingo 8:00-18:00',
        'RangoLibre.integer'=>'No se atiende de 12:00 a 14:00 ',
        'choques.integer'=>'No deben chocar citas con otros pacientes',
        'minCita.integer'=>'Las citas no deben durar menos de 30 minutos',
        'maxCita.integer'=>'Las citas no deben durar mas de 3 horas'

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
           
                'txtFecha.after'=>'La cita no debe ser programada para hoy mismo o dias anteriores',
                'pacienteID.required'=>'campo requerido',
                'RangoStartHora.between'=>'Horarios de atencion dia sábado 8:00-15:00',
                'RangoEndHora.between'=>'Horarios de atencion dia sábado 8:00-15:00',
                'RangoLibre.integer'=>'No se atiende de 12:00 a 14:00 ',
                'choques.integer'=>'No deben chocar citas con otros pacientes',
                'minCita.integer'=>'Las citas no deben durar menos de 30 minutos',
                'maxCita.integer'=>'Las citas no deben durar mas de 3 horas'

                ];
        }

    }

}
