<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
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
            'name'=>'unique:roles|required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|max:120|string',
            'slug'=>'unique:roles|required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|max:120|string',
            'description'=>'required|regex:/^[^0-9]+$/|max:500|string',
        ];
    }

    public function messages()
    {
        $obligatorio= 'El campo es obligatorio';
        return[
            'name.required'=>$obligatorio,
            'name.regex'=>'El campo no debe tener numeros y simbolos',
            'name.max'=>'El campo debe tener menos de 120 caracteres',
            'name.unique'=>'El nombre ya existe en los registros',

            'slug.require'=>$obligatorio,
            'slug.regex'=>'El campo no debe tener numeros y simbolos',
            'slug.max'=>'El campo debe tener menos de 120 caracteres',
            'slug.unique'=>'El valor ya existe en los registros',

            'descripcion.required'=>$obligatorio,
            'descripcion.regex'=>'El campo no debe contener caracteres numericos',
            'descripcion.max'=>'El campo debe tener menos de 500 caracteres'

        ];
    }
}
