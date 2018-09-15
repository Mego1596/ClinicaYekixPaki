<?php

namespace App\Http\Controllers;


use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\RolesRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request)
    {
        $valores = $request->all();
        if(is_null($valores['name']) or is_null($valores['slug']))
        {
            return redirect()
                ->route('roles.create')
                ->with('error', 'Complete los campos obligatorios');
        }
        else 
        {
            $role = Role::create($request->all());
            $role->permissions()->sync($request->get('permissions'));
            return redirect()->route('roles.index')->with('info','Rol guardado con exito'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {      
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $role = Role::find($id);
        $permissions = Permission::get();
        return view('roles.edit', compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RolesRequest $request, Role $role)
    {
        $valores = $request->all();
        if(is_null($valores['name']) or is_null($valores['slug']))
        {
            return redirect()
                ->route('roles.create')
                ->with('error', 'Complete los campos obligatorios');
        }
        else 
        {
            $role->update($request->all());
            $role->permissions()->sync($request->get('permissions'));
            return redirect()->route('roles.index',$role->id)
                ->with('info','Rol actualizado con exito');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('info','Eliminado Correctamente');
    }
}