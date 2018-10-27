<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anexo;
use App\TipoAnexo;

class OdontogramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($paciente)
    {
        return view('odontograma.index')->with('paciente', $paciente);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $paciente)
    {
        $tipoMensaje = "success";
        $mensaje = "Odontograma guardado con éxito";
        $image = $request->imagen;
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $generado = str_random(25) . '.png';
        $guardado = \Storage::disk('dropbox')->put($generado,  base64_decode($image));

        if($guardado) {
            $anexo = new Anexo();
            $anexo->nombreOriginal = $generado;
            $anexo->ruta = $generado;
            $anexo->pacienteId = $paciente;
            $anexo->tipoAnexoId = TipoAnexo::ODONTOGRAMA;
            $anexo->save();

            return redirect()
                    ->route('paciente.show', $paciente)
                    ->with('info','Odontograma guardado con exito')
                    ->with('tipo', 'success');
        }else {
            return redirect()
                    ->route('paciente.show', $paciente)
                    ->with('error', 'No se pudo guardar el odontograma.')
                    ->with('tipo', 'danger');
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
