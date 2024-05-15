<?php

namespace App\Http\Controllers\Api;

use App\Models\Moduls;
use App\Models\Usuaris;
use App\Models\CriterisAvaluacio;
use App\Models\ResultatsAprenentatge;
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

    public function ra($id)
    {
        // Obtener los resultados de aprendizaje asociados al módulo
        $resultadosAprendizaje = ResultatsAprenentatge::where('moduls_id', $id)->get();

        // Iterar sobre cada resultado de aprendizaje y cargar los criterios de evaluación asociados
        foreach ($resultadosAprendizaje as $resultado) {
            $resultado->criterisAvaluacio = CriterisAvaluacio::where('resultats_aprenentatge_id', $resultado->id)->get();
        }

        return response()->json($resultadosAprendizaje);
    }
    
}
