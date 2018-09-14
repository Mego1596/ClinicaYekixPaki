<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
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
            'nombre1'=>'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|max:50|string',
            'nombre2'=>'nullable|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|max:50|string',
            'nombre3'=>'nullable|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|max:50|string',
            'apellido1'=>'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|max:50|string',
            'apellido2'=>'nullable|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|max:50|string',
            'fechaNacimiento'=>'required|date|before:2016-01-01|after:1900-01-01',
            'telefono'=>'required|min:9|max:9|regex:/^[762]{1}[0-9]{3}-[0-9]{4}$/',
            'ocupacion' => 'required|string|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'sexo'=>'required|string|regex:/^[MF]$/',
            'email'=>'nullable|string|email|unique:users|max:90|min:5',
            'recomendado'=>'nullable|string|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'historiaOdontologica'=>'nullable|string|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'historiaMedica'=>'nullable|string|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'domicilio'=>'required|string|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'direccion_de_trabajo'=>'nullable|string|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'responsable'=>'nullable|string|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/'

        ];  
    }
    
    public function messages(){
        $regex="Caracteres permitidos [a-záéíóúñ] mayusculas y minusculas";
        $required="El campo es obligatorio";
        $cadena="Debe ser formato string";
        $max="Debe contener menos de 50 caracteres.";
        
        return [

            /*requeridos*/
            'nombre1.required'=>$required,
            'apellido1.required'=>$required,
            'fechaNacimiento.required'=>$required,
            'telefono.required'=>$required,
            'ocupacion.required'=>$required,
            'sexo.required'=>$required,
            'domicilio.required'=>$required,


            /*string*/
            'nombre1.string'=>$cadena,
            'nombre3.string'=>$cadena,
            'nombre2.string'=>$cadena,
            'apellido1.string'=>$cadena,
            'apellido2.string'=>$cadena,
            'ocupacion.string'=>$cadena,
            'sexo.string'=>$cadena,
            'recomendado.string'=>$cadena,
            'historiaOdontologica'=>$cadena,
            'historiaMedica.regex'=>$regex,
            'domicilio.regex'=>$regex,
            'direccion_de_trabajo.regex'=>$regex,
            'responsable.regex'=>$regex, 
            /*regex*/
            'nombre1.regex'=>$regex,
            'nombre2.regex'=>$regex,
            'nombre3.regex'=>$regex,
            'apellido1.regex'=>$regex,
            'apellido2.regex'=>$regex,
            'ocupacion.regex'=>$regex,
            'telefono.regex'=>"Número debe ser formato xxxx-xxxx",
            'sexo.regex'=>"Debe ser hombre o mujer (M/F)",  
            'recomendado.regex'=>$regex,
            'historiaOdontologica.regex'=>$regex,
            'historiaMedica.regex'=>$regex,
            'domicilio.regex'=>$regex,
            'direccion_de_trabajo.regex'=>$regex,
            'responsable.regex'=>$regex,

            /*max and min*/
            'nombre1.max'=>$max,
            'nombre2.max'=>$max,
            'nombre3.max'=>$max,
            'apellido1.max'=>$max,            
            'apellido2.max'=>$max,
            'telefono.max'=>'Debe tener 9 caracteres',
            'telefono.min'=>'Debe tener 9 caracteres',
            'email.max'=>"Debe contener menos de 90 caracteres",
            'email.min'=>"Debe de tener mas de 6 caracteres",
            
            /*unicos*/
            'email.unique'=>"Email debe ser unico en los registros",
            'email.email'=>"Debe ser un email correcto",
            "fechaNacimiento.date"=>"Debe ser una fecha",
            "fechaNacimiento.before"=>"La fecha debe ser antes de 2016-01-01",
            "fechaNacimiento.after"=>"La fecha debe ser despues de 1900-01-01",
        ];
    }
}
