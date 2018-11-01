<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Anexo;
use App\Paciente;
use App\TipoAnexo;

class OdontogramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Paciente $paciente)
    {
        //Provicional odontograma en la base de datos
        $odontograma = $paciente->anexos->last();
        //$ultimoOdontograma = $paciente->anexos->last();
        //$odontograma = null;
        //if($ultimoOdontograma) {
        //    if(\Storage::disk('dropbox')->exists($ultimoOdontograma->ruta)) {
        //        $odontograma = \Storage::disk('dropbox')->get($ultimoOdontograma->ruta);
        //    }else {
        //        $ultimoOdontograma->delete();
        //    }
        //}
        return view('odontograma.index')->with('paciente', $paciente)->with('odontograma', $odontograma);
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
    public function store(Request $request, Paciente $paciente)
    {
        //Guardado provicional de la imagen en la base de datos
        //Borrar cualquier odontograma con fecha de HOY, para dejar solo uno por día
        $hoy = Carbon::now()->toDateString();
        $anexosHoy = $paciente->anexos()->where('tipoAnexoId', TipoAnexo::ODONTOGRAMA)->whereDate('created_at', $hoy)->get();
        foreach ($anexosHoy as $anexoEliminar) {
            $anexoEliminar->delete();
        }

        $anexo = new Anexo();
        $anexo->nombreOriginal = str_random(25) . '.png';
        $anexo->ruta = $request->imagen;
        $anexo->pacienteId = $paciente->id;
        $anexo->tipoAnexoId = TipoAnexo::ODONTOGRAMA;
        $anexo->save();

        return redirect()
                    ->route('paciente.show', $paciente)
                    ->with('info','Odontograma guardado con exito')
                    ->with('tipo', 'success');


        /*$tipoMensaje = "success";
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
        }   */     
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
