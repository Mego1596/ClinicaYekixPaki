<?php

namespace App\Http\Controllers;

use App\Procedimiento;
use Illuminate\Http\Request;
use App\Http\Requests\ProcedimientosRequest;
use App\Http\Requests\ProcedimientosUpdateRequest;

class ProcedimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procedimientos = Procedimiento::paginate(10);
        return view('procedimiento.index', compact('procedimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('procedimiento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcedimientosRequest $request)
    {
        $valores = $request->all();
        $colores_guardados = Procedimiento::get()->all();
        $existe = false;

        //validacion de si color existe
        foreach ($colores_guardados as $valor)
        {
            if($valores['color'] == $valor['color'])    
                $existe = true;
        }
        //validacion de dos primeros campos
        if(is_null($valores['nombre']) or is_null($valores['descripcion']))
        {
            if($existe) //si existe el color elegido muestra el error
                return redirect()->route('procedimiento.create')
                ->with('error', 'Complete los campos obligatorios y cambie de color de identificador');
            else
                return redirect()->route('procedimiento.create')
                ->with('error', 'Complete los campos obligatorios');
        } 
        else if ($existe) //validacion de solo color aun cuando los demas campos tengan valor
        {
            return redirect()->route('procedimiento.create')
            ->with('error', 'Cambie de color de identificador');
        }
        else //validacion aprobada
        {
            $procedimiento = Procedimiento::create($request->all());
            return redirect()->route('procedimiento.index')->with('info','Procedimiento guardado con exito');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Procedimiento $procedimiento)
    {      
        return view('procedimiento.show', compact('procedimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $procedimiento = Procedimiento::find($id);
        return view('procedimiento.edit', compact('procedimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function update(ProcedimientosUpdateRequest $request, Procedimiento $procedimiento)
    {
        $valores = $request->all();
        $colores_guardados = Procedimiento::get()->all();
        $existe = false;

        //validacion de si color existe
        foreach ($colores_guardados as $valor)
        {
            if($valores['color'] == $valor['color'])    
                $existe = true;
        }
        //validacion de dos primeros campos
        if(is_null($valores['nombre']) or is_null($valores['descripcion']))
        {
            if($existe) //si existe el color elegido muestra el error
                return redirect()->route('procedimiento.create')
                ->with('error', 'Complete los campos obligatorios y cambie de color de identificador');
            else
                return redirect()->route('procedimiento.create')
                ->with('error', 'Complete los campos obligatorios');
        } 
        
        else //validacion aprobada
        {
            $procedimiento->update($request->all());
            return redirect()->route('procedimiento.index')->with('info','Procedimiento actualizado con exito');
        }



        $procedimiento->update($request->all());
        return redirect()->route('procedimiento.edit',$procedimiento->id)->with('info','Procedimiento actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Procedimiento $procedimiento)
    {
        $procedimiento->delete();
        return back()->with('info','Procedimiento eliminado correctamente');
    }
}
