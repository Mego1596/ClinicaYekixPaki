<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $ruta;
    public function __construct(Route $ruta)
    {
        $this->ruta=$ruta;    
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
        return [
            'nombre1'=>'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|max:50|string',
            'nombre2'=>'nullable|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|max:50|string',
            'nombre3'=>'nullable|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|max:50|string',
            'apellido1'=>'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|max:50|string',
            'apellido2'=>'nullable|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|max:50|string',
            'email'=>['nullable','string','email',
            Rule::unique('users')->ignore($this->ruta->parameter('user')),
            'max:90',
            'min:5'],
            'numeroJunta'=>'nullable|string|min:6|regex:/^JVPO-[0-9]*/',
            'especialidad'=>'nullable|string|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/'

        ];
    }

    public function messages()
    {
        $regex="No debe contener numeros o simbolos";
        $required="El campo es obligatorio";
        $cadena="Debe ser formato string";
        $max="Debe contener menos de 50 caracteres.";
        return [
/*requeridos*/
            'nombre1.required'=>$required,
            'apellido1.required'=>$required,



            /*string*/
            'nombre1.string'=>$cadena,
            'nombre3.string'=>$cadena,
            'nombre2.string'=>$cadena,
            'apellido1.string'=>$cadena,
            'apellido2.string'=>$cadena,
            'especialidad.string'=>$cadena,
            'numeroJunta.string'=>$cadena,

            /*regex*/
            'nombre1.regex'=>$regex,
            'nombre2.regex'=>$regex,
            'nombre3.regex'=>$regex,
            'apellido1.regex'=>$regex,
            'apellido2.regex'=>$regex,
            'numeroJunta.regex'=>"Formato debe ser JVPO-xxxx ",
            'especialidad.regex'=>$regex,    
            /*max and min*/
            'nombre1.max'=>$max,
            'nombre2.max'=>$max,
            'nombre3.max'=>$max,
            'apellido1.max'=>$max,            
            'apellido2.max'=>$max,
            'numeroJunta.min'=>'debe contener mas de 6 caracteres',
            'email.max'=>"Debe contener menos de 90 caracteres",
            'email.min'=>"Debe de tener mas de 6 caracteres",
            
            /*unicos*/
            'email.unique'=>"El email ya existe en los registros",
            'email.email'=>"Debe ser un email correcto",
        ];
    }
}
