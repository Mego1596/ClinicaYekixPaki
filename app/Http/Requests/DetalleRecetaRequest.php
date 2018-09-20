<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetalleRecetaRequest extends FormRequest
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
            'medicamento'=>'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|max:200',
            'dosis'=>'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\.])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\.]*)*)+$/|max:200',
            'cantidad'=>'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\.])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\.]*)*)+$/|max:200'
        ];
    }
    public function messages(){
        return [
            'medicamento.required'=>'Campo requerido',
            'dosis.required'=>'Campo requerido',
            'cantidad.required'=>'Campo requerido',
            'medicamento.regex'=>'Campo debe ser texto',
            'dosis.regex'=>'Campo de debe ser alfanumerico',
            'cantidad.regex'=>'Campo debe ser alfanumerico',
            'medicamento.max'=>'campo no debe exceder los 200 caracteres',
            'dosis.max'=>'campo no debe exceder los 200 caracteres',
            'cantidad.max'=>'campo no debe exceder los 200 caracteres',
        ];
    }
}
