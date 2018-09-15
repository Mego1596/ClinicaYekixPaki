<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcedimientosUpdateRequest extends FormRequest
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
                'nombre'=>'required|regex:/^[^0-9]+$/|max:120|string',
                'descripcion'=>'required|regex:/^[^0-9]+$/|max:500|string',
                'color'=>'required|regex:/^#[0-9ABDCDEFabcdef]+$/'
            ];
        
    }
    public function messages()
    {
        return [
        'nombre.required'=>'El campo es obligatorio',
        'nombre.regex'=>'El campo no debe contener caracteres numericos',
        'nombre.max'=>'Deben ser menos de 120 caracteres',

        'descripcion.required'=>'El campo es obligatorio',
        'descripcion.regex'=>'El campo no debe contener caracteres numericos',
        'descripcion.max'=>'Deben ser menos de 500 caracteres',

        'color.required'=>'Debe escoger un color',
        'color.regex'=>'No es un color valido',
    ];
    }
}
