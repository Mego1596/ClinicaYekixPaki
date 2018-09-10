<?php

namespace App\Http\Controllers;

use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)->select('users.id' , 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
        $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
        $datos= json_encode($result);
        $sub = substr($datos, 10,-3);
        return view('user.index', compact('users','sub'));
    }

     public function asistentes()
    {
        $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 3)->select('users.id' , 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.name')->paginate();
        $result = DB::table('roles')->where('slug','asistente')->select('slug')->get();
        $datos= json_encode($result);
        $sub = substr($datos, 10,-3);
        return view('user.asistente', compact('users','sub'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idRole)
    {
        $roles = Role::get();
        return view('user.create',compact('roles','idRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request['idRole'] == 'doctor'){
            if(is_null($request['nombre1']) or is_null($request['apellido1']) or $request['numeroJunta'] == 'JVPO-' or is_null($request['email'])  or is_null($request['roles'])){
                return redirect()->route('user.create',$request->idRole)
                ->with('error', 'Complete los Campos Obligatorios o digite correctamente el Numero de Junta')
                ->with('tipo', 'danger');
            }
        }else{
            if(is_null($request['nombre1']) or is_null($request['apellido1']) or is_null($request['email'])  or is_null($request['roles'])){
                return redirect()->route('user.create',$request->idRole)
                ->with('error', 'Complete los Campos Obligatorios')
                ->with('tipo', 'danger');
            }
        }
        
        $numero = DB::table('users')->select('correlativo')->max('correlativo')+1;
        $user = new User();
        $user->correlativo = $numero;
        $user->nombre1 = $request->nombre1;
        $user->apellido1 = $request->apellido1;
        $user->name = $request->nombre1.".".$request->apellido1.$numero;
        $user->email = $request->email;
        $user->numeroJunta = $request->numeroJunta;
        $user->especialidad = $request->especialidad;
          /**generando password */
        $password=substr(md5(microtime()),1,6);
        if(!is_null($request['nombre2']))
            $user->nombre2 = $request->nombre2;
        if(!is_null($request['nombre3']))
            $user->nombre3 = $request->nombre3;
        if(!is_null($request['apellido2']))
            $user->apellido2 = $request->apellido2;
        $user->password = $password;
             //** enviando email, contraseña */
        Mail::send('email.paciente', ['user'=>$user], function ($m) use ($user) {
                $m->to($user->email,$user->nombre1);
                $m->subject('Contraseña y nombre de usuario');
                $m->from('clinicaYekixPaki@gmail.com','YekixPaki');
        });

        $user->password =bcrypt($request->password);
        if($user->save()){
            $user->roles()->sync($request->get('roles'));
            if($request['role']=='doctor'){
                return redirect()->route('user.index')->with('info','Usuario guardado con exito');
            }elseif ($request['role']=='asistente') {
                return redirect()->route('user.asistente')->with('info','Usuario guardado con exito');
            }
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user,$idRole)
    {      
        return view('user.show', compact('user','idRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$idRole)
    {   
        $user = User::find($id);
        $roles = Role::get();
        return view('user.edit', compact('user','roles','idRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        if($request['idRole'] == 'doctor'){
            if(is_null($request['nombre1']) or is_null($request['apellido1']) or $request['numeroJunta'] == 'JVPO-' or is_null($request['email']) ){
                return redirect()->route('user.edit',[$user->id, $request->role])
                ->with('error', 'Complete los Campos Obligatorios o digite correctamente el Numero de Junta')
                ->withInput($request->all())
                ->with('tipo', 'danger');
            }
        }else{
            if(is_null($request['nombre1']) or is_null($request['apellido1']) or is_null($request['email']) ){
                return redirect()->route('user.edit',[$user->id, $request->role])
                ->with('error', 'Complete los Campos Obligatorios')
                ->withInput($request->all())
                ->with('tipo', 'danger');
            }
        }

        $userAux = User::find($user->id);
        $userAux->nombre1     = $request->nombre1;
        $userAux->nombre2     = $request->nombre2;
        $userAux->nombre3     = $request->nombre3;
        $userAux->apellido1   = $request->apellido1;
        $userAux->apellido2   = $request->apellido2;
        $userAux->email       = $request->email;
        $userAux->numeroJunta = $request->numeroJunta;
        $userAux->especialidad = $request->especialidad;
        if($userAux->save()){
            if($request['role']=='doctor'){
                    return redirect()->route('user.index')->with('info','Usuario Actualizado con exito');
            }elseif ($request['role']=='asistente') {
                    return redirect()->route('user.asistente')->with('info','Usuario Actualizado con exito');
                }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('info','Eliminado Correctamente');
    }

    public function revocarRol( User $user, $idRole){
         $user->roles()->sync(4);

         if($idRole=='doctor'){
                return redirect()->route('user.index')->with('info','Usuario guardado con exito');
        }elseif ($idRole=='asistente') {
                return redirect()->route('user.asistente')->with('info','Usuario guardado con exito');
            }

    }

        public function search1(Request $request){

        if($request['buscador']!='Buscar Por...'){
            if($request['buscador'] == 'Nombre'){

                if(!is_null($request['buscar'])){
                    $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)->
                    where(  function ($query) use ($request) {
                        $query->where('nombre1','ILIKE',$request->buscar."%")
                              ->orWhere('nombre2','ILIKE',$request->buscar."%")
                              ->orWhere('nombre3','ILIKE',$request->buscar."%");
                    })->select('users.id', 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
                    $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
                    $datos= json_encode($result);
                    $sub = substr($datos, 10,-3);
                    return view('user.index', compact('users','sub'))
                           ->with('info', 'Busqueda Exitosa');
                }
                else{
                    $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)->select('users.id' , 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
                    $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
                    $datos= json_encode($result);
                    $sub = substr($datos, 10,-3);
                    return view('user.index', compact('users','roles','sub'))
                           ->with('info', 'Busqueda Exitosa');
                }
            }elseif ($request['buscador'] == 'Apellido') {
               if(!is_null($request['buscar'])){
                    $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)->
                    where(  function ($query) use ($request) {
                        $query->where('apellido1','ILIKE',$request->buscar."%")
                              ->orWhere('apellido2','ILIKE',$request->buscar."%");
                    })->select('users.id', 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
                    $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
                    $datos= json_encode($result);
                    $sub = substr($datos, 10,-3);
                    return view('user.index', compact('users','sub'))
                           ->with('info', 'Busqueda Exitosa');
                }
                else{
                    $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)->select('users.id' , 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
                    $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
                    $datos= json_encode($result);
                    $sub = substr($datos, 10,-3);
                    return view('user.index', compact('users','roles','sub'))
                           ->with('info', 'Busqueda Exitosa');
                }
            }elseif ($request['buscador'] == 'No. de Junta') {
               if(!is_null($request['buscar'])){
                    $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)->where('numeroJunta','ILIKE',$request->buscar."%")->select('users.id', 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
                    $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
                    $datos= json_encode($result);
                    $sub = substr($datos, 10,-3);
                    return view('user.index', compact('users','sub'))
                           ->with('info', 'Busqueda Exitosa');
                }
                else{
                    $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)->select('users.id' , 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
                    $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
                    $datos= json_encode($result);
                    $sub = substr($datos, 10,-3);
                    return view('user.index', compact('users','roles','sub'))
                           ->with('info', 'Busqueda Exitosa');
                }
            }elseif ($request['buscador'] == 'Nombre de Usuario') {
                if(!is_null($request['buscar'])){
                    $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)->where('name','ILIKE',$request->buscar."%")->select('users.id', 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
                    $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
                    $datos= json_encode($result);
                    $sub = substr($datos, 10,-3);
                    return view('user.index', compact('users','sub'))
                           ->with('info', 'Busqueda Exitosa');
                }else{
                    $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)->select('users.id' , 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
                    $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
                    $datos= json_encode($result);
                    $sub = substr($datos, 10,-3);
                    return view('user.index', compact('users','roles','sub'))
                           ->with('info', 'Busqueda Exitosa');
                }
        }else{
            $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)->select('users.id' , 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
            $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
            $datos= json_encode($result);
            $sub = substr($datos, 10,-3);
            return view('user.index', compact('users','roles','sub'))
                   ->with('info', 'Busqueda Exitosa');
        }

    }
}

    public function search2(Request $request) {
            if($request['buscador']!='Buscar Por...'){
                
            if($request['buscador'] == 'Nombre'){
                if(!is_null($request['buscar'])){
                    $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 3)->
                    where(  function ($query) use ($request) {
                        $query->where('nombre1','ILIKE',$request->buscar."%")
                              ->orWhere('nombre2','ILIKE',$request->buscar."%")
                              ->orWhere('nombre3','ILIKE',$request->buscar."%");
                    })->select('users.id', 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
                    $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
                    $datos= json_encode($result);
                    $sub = substr($datos, 10,-3);
                    return view('user.asistente', compact('users','sub'))
                           ->with('info', 'Busqueda Exitosa');
                }
                else{
                    $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 3)->select('users.id' , 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
                    $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
                    $datos= json_encode($result);
                    $sub = substr($datos, 10,-3);
                    return view('user.asistente', compact('users','roles','sub'))
                           ->with('info', 'Busqueda Exitosa');
                }
            }elseif ($request['buscador'] == 'Apellido') {
                if(!is_null($request['buscar'])){
                    $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 3)->
                    where(  function ($query) use ($request) {
                        $query->where('apellido1','ILIKE',$request->buscar."%")
                              ->orWhere('apellido2','ILIKE',$request->buscar."%");
                    })->select('users.id', 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
                    $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
                    $datos= json_encode($result);
                    $sub = substr($datos, 10,-3);
                    return view('user.asistente', compact('users','sub'))
                           ->with('info', 'Busqueda Exitosa');
                }
                else{
                    $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 3)->select('users.id' , 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
                    $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
                    $datos= json_encode($result);
                    $sub = substr($datos, 10,-3);
                    return view('user.asistente', compact('users','roles','sub'))
                           ->with('info', 'Busqueda Exitosa');
                }

            }elseif ($request['buscador'] == 'Nombre de Usuario') {
                if(!is_null($request['buscar'])){
                    $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 3)->where('name','ILIKE',$request->buscar."%")->select('users.id', 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
                    $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
                    $datos= json_encode($result);
                    $sub = substr($datos, 10,-3);
                    return view('user.asistente', compact('users','sub'))
                           ->with('info', 'Busqueda Exitosa');
                }
                else{
                    $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 3)->select('users.id' , 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.numeroJunta','users.name')->paginate();
                    $result = DB::table('roles')->where('slug','doctor')->select('slug')->get();
                    $datos= json_encode($result);
                    $sub = substr($datos, 10,-3);
                    return view('user.asistente', compact('users','roles','sub'))
                           ->with('info', 'Busqueda Exitosa');
                }
            
        }else{
            $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 3)->select('users.id' , 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2','users.name')->paginate();
            $result = DB::table('roles')->where('slug','asistente')->select('slug')->get();
            $datos= json_encode($result);
            $sub = substr($datos, 10,-3);
            return view('user.asistente', compact('users','sub'));
        }

    }
    }
}
