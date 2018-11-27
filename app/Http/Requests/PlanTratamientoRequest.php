<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Plan_Tratamiento;
use Illuminate\Http\Request;

class PlanTratamientoRequest extends FormRequest
{


    public function __construct(Request $request)
    {
        $citaProveniente=$_POST['events_id'];
        $planes=Plan_Tratamiento::where('events_id',$citaProveniente)->get();
     
        $request['escape']=$planes->contains('procedimiento_id',$request['procedimiento_id'])?'exit':'1';


    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
        return [
            "no_de_piezas"=>'required|integer|max:32|min:0',
            "honorarios"=>'required|numeric|min:0|max:999999.99',
            'procedimiento_id'=>'required|integer',
            'escape'=>'integer',
        ];
    }


    public function messages()
    {
        return [
            'no_de_piezas.required'=>'El numero de piezas es requerido',
            'no_de_piezas.integer'=>'El dato debe ser tipo entero',
            'no_de_piezas.max'=>'El dato debe ser menor o igual a 32',
            'no_de_piezas.min'=>'El dato debe ser mayor a 0',
            'honorarios.required'=>'Los honorararios son requeridos',
            'honorarios.numeric'=>'debe ser tipo numerico',
            'honorarios.min'=>'debe ser mayor que cero',
            'honorarios.max'=>'debe ser menor que 999,999.99',
            'procedimiento_id.required'=>'El campo es requerido',
            'procedimiento_id.integer'=>'debe seleccionar una opcion',
            'escape.integer'=>'el procedimiento debe ser diferente por cada plan'
        ];
    }
}
