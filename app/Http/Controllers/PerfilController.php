<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class PerfilController extends Controller
{
    
    public function index(){
        $user=Auth::user();
        $rol=$user->roles->first();
        return view('perfil.index',compact('user','rol'));
    }

    public function changePassword(Request $request){
        $currentPassword=Auth::user()->password;
       // dd($request->all());
        if($request->input('nueva')== null|| $request->input('actual')==null)
        {
            $request->session()->flash('error','Ingrese datos en ambos campos');
        }
        else if(Hash::check($request->input('actual'),$currentPassword))
        {
            $user=User::find(Auth::user()->id);
            $user->password=bcrypt($request->input('nueva'));
            $user->update();
            $request->session()->flash('info','contraseña cambiada con exito');
        }
        else{
            $request->session()->flash('error','contraseña, no coincide con los registros');
            
        }

        return redirect()->route('perfil.index');
    }

}
