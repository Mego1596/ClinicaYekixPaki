<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecetaRequest extends FormRequest
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
            'peso'=>'numeric|max:600|min:0|required'
        ];
    }

    public function messages(){ 
        return [
            'peso.numeric'=>'El valor debe ser numerico',
            'peso.max'=>'El peso no debe exceder de 600 libras',
            'peso.min'=>'El valor debe ser mayor que cero',
            'peso.required'=>'El peso es requerido'
        ];

    }
}
