<?php

namespace App\Http\Controllers\Api;

use App\Models\Moduls;
use App\Models\Usuaris;
use App\Models\CriterisAvaluacio;
use App\Models\ResultatsAprenentatge;
use App\Models\Rubriques; // Importa el modelo de Rubriques
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AutoavaluacioApi extends Controller
{
    public function index()
    {
        // Aquí puedes definir la lógica para la función index si es necesario
    }

    public function store(Request $request)
    {
        // Aquí puedes definir la lógica para la función store si es necesario
    }
    public function show($id)
    {
    }
    

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
        // Aquí puedes definir la lógica para la función destroy si es necesario
    }

    public function modulos($id)
    {
        // Busca el usuario por su ID
        $usuario = Usuaris::findOrFail($id);
    
        // Obtén los módulos matriculados por el usuario
        $modulos = $usuario->moduls()->get();
    
        // Retorna los módulos en formato JSON
        return response()->json($modulos);
    }

    public function ra($id, $idusuario)
    {
        // Obtener los resultados de aprendizaje asociados al módulo
        $resultadosAprendizaje = ResultatsAprenentatge::where('moduls_id', $id)->get();
    
        // Iterar sobre cada resultado de aprendizaje y cargar los criterios de evaluación asociados
        foreach ($resultadosAprendizaje as $resultado) {
            $resultado->criterisAvaluacio = CriterisAvaluacio::where('resultats_aprenentatge_id', $resultado->id)->get();
    
            // Obtener las descripciones de las rubricas asociadas a cada criterio
            foreach ($resultado->criterisAvaluacio as $criterio) {
                $criterio->rubricas = Rubriques::where('criteris_avaluacio_id', $criterio->id)->orderBy('nivell')->get();
                
                // Obtener la nota del usuario para este criterio
                $nota = Usuaris::find($idusuario)->alumnesHasCriterisAvaluacio()
                                ->where('criteris_avaluacio_id', $criterio->id)
                                ->value('nota');
                // Asignar la nota al criterio
                $criterio->nota = $nota;
            }
        }
    
        return response()->json($resultadosAprendizaje);
    }







    
    public function updateNotas(Request $request, $idusuario )
{
    dd("ola");


    // Obtener los datos enviados en la solicitud
    $criterio = $request->all();

    // Iterar sobre los datos y actualizar las notas en la base de datos

        $usuario = Usuaris::findOrFail($idusuario);
        // Buscar el criterio por su ID y actualizar la nota
        $criterioAActualizar = CriterisAvaluacio::findOrFail($criterio['id']);
        
        $criterioAActualizar->update(['nota' => $criterio['nota']]);
    

    // Retornar una respuesta de éxito
    return response()->json(['message' => 'Notas actualizadas correctamente'], 200);
}

    
}

