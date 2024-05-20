<?php

namespace App\Http\Controllers\Api;

use App\Models\Moduls;
use App\Models\Usuaris;
use App\Models\CriterisAvaluacio;
use App\Models\ResultatsAprenentatge;
use App\Models\Rubriques;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AutoavaluacioApi extends Controller
{
    public function modulos($id)
    {
        $usuario = Usuaris::findOrFail($id);
        $modulos = $usuario->moduls()->get();
        return response()->json($modulos);
    }

    public function ra($id, $idusuario)
    {
        $resultadosAprendizaje = ResultatsAprenentatge::where('moduls_id', $id)->get();

        foreach ($resultadosAprendizaje as $resultado) {
            $resultado->criterisAvaluacio = CriterisAvaluacio::where('resultats_aprenentatge_id', $resultado->id)->get();

            foreach ($resultado->criterisAvaluacio as $criterio) {
                $criterio->rubricas = Rubriques::where('criteris_avaluacio_id', $criterio->id)->orderBy('nivell')->get();

                $nota = Usuaris::find($idusuario)->alumnesHasCriterisAvaluacio()
                                ->where('criteris_avaluacio_id', $criterio->id)
                                ->value('nota');
                $criterio->nota = $nota;
            }
        }

        return response()->json($resultadosAprendizaje);
    }


    public function updateNota(Request $request)
    {
        $validatedData = $request->validate([
            'usuaris_id' => 'required|exists:usuaris,id',
            'criteris_avaluacio_id' => 'required|exists:criteris_avaluacio,id',
            'nota' => 'required|numeric|min:0|max:10', // ajusta las validaciones según tus requisitos
        ]);
    
        // Actualizar o crear la nota en la tabla 'alumnes_has_criteris_avaluacio'
        $usuario = Usuaris::findOrFail($validatedData['usuaris_id']);
        $usuario->alumnesHasCriterisAvaluacio()->updateExistingPivot(
            $validatedData['criteris_avaluacio_id'],
            ['nota' => $validatedData['nota']]
        );
    
        return response()->json(['message' => 'Nota actualizada correctamente.']);
    }
    
    
}
