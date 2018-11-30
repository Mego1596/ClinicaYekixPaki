<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanTratamientoUpdateRequest extends FormRequest
{

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
           
        ];
    }
}
