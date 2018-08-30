<?php

namespace App\Http\Controllers;

use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)->select('users.id' , 'users.nombre1','users.nombre2','users.nombre3','users.apellido1','users.apellido2')->paginate();
        $result = DB::table('roles')->where('slug','doctor')->select('name')->get();
        $datos= json_encode($result);
        $sub = substr($datos, 10,-3);
        return view('user.index', compact('users','sub'));
    }

     public function asistentes()
    {
        $users = DB::table('users')->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 3)->select('users.id' , 'users.name')->paginate();
        $result = DB::table('roles')->where('slug','asistente')->select('name')->get();
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
        $user = new User();
        $user->nombre1 = $request->nombre1;
        $user->apellido1 = $request->apellido1;
        $user->name = $request->nombre1.".".$request->apellido1;
        $user->email = $request->email;
        $user->password =bcrypt($request->password);

        if(!is_null($request['nombre2']))
            $user->nombre2 = $request->nombre2;
        if(!is_null($request['nombre3']))
            $user->nombre3 = $request->nombre3;
         if(!is_null($request['apellido2']))
            $user->apellido2 = $request->apellido2;
        if($user->save()){
            $user->roles()->sync($request->get('roles'));
            if($request['role']=='Dentista'){
                return redirect()->route('user.index')->with('info','Usuario guardado con exito');
            }elseif ($request['role']=='Asistente') {
                return redirect()->route('user.asistente')->with('info','Usuario guardado con exito');
            }
        }
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
        $user->update($request->all());

        $user->roles()->sync($request->get('roles'));
        return redirect()->route('user.index',$user->id)->with('info','Usuario actualizado con exito');
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
}
