<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anexo;

class AnexoController extends Controller
{

    public function download($file)
    {
        $anexo = Anexo::where('ruta', $file)->get()[0];
        if(\Storage::disk('dropbox')->exists($anexo->ruta)) {
            return \Storage::disk('dropbox')->download($anexo->ruta);
        } else {
            $anexo->delete();
            return redirect()
                    ->route('paciente.show', $anexo->paciente->id)
                    ->with('error', 'El archivo que intenta Descargar: '. $anexo->nombreOriginal.' No existe. Se eliminará de la Base de datos')
                    ->with('tipo', 'danger');
        }
    }

    //Eliminar un Archivo del Expediente de un Paciente
    public function destroy(Request $request, Anexo $file)
    {
        if(\Storage::disk('dropbox')->exists($file->ruta)) {
            if(\Storage::disk('dropbox')->delete($file->ruta)) {
                $file->delete();
                return redirect()
                    ->route('paciente.show', $file->paciente->id)
                    ->with('info', 'Se elimino correctamente el archivo: '. $file->nombreOriginal)
                    ->with('tipo', 'success');
            } else {
                return redirect()
                    ->route('paciente.show', $file->paciente->id)
                    ->with('error', 'No se pudo eliminar el archivo: '. $file->nombreOriginal)
                    ->with('tipo', 'danger');
            }
        } else {
            $file->delete();
            return redirect()
                    ->route('paciente.show', $file->paciente->id)
                    ->with('error', 'El archivo que intenta eliminar: '. $file->nombreOriginal.' No existe. Se eliminará de la Base de datos')
                    ->with('tipo', 'danger');
        }
    }
}
