<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuaris;
use App\Models\Moduls;
use Illuminate\Http\Request;
use App\Clases\Utilitat;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\MatriculaResource;

class MatriculaController extends Controller
{

    public function index()
    {
    }

    public function store(Request $request)
    {
        try {
            // Encontrar el módulo y el usuario
            $idModuls = $request->input('moduls_id');
            $idUsuari = $request->input('usuaris_id');
            $usuario = Usuaris::findOrFail($idUsuari);
            $moduls = Moduls::findOrFail($idModuls);

            // Asociar el usuario al módulo
            $usuario->moduls()->attach($moduls);
            
            // Mensaje de éxito
            $mensaje = 'Usuario matriculado en el módulo';
            $status = 201;
        } catch (QueryException $ex) {
            // Mensaje de error si falla la consulta
            $mensaje = Utilitat::errorMessage($ex);
            $status = 400;
        }

        // Devolver la respuesta
        return response()->json(['mensaje' => $mensaje], $status);
    }


    // public function show(Usuaris $usuaris)
    // {
    //     //
    // }

    // public function update(Request $request, Usuaris $usuaris)
    // {
    //     //
    // }

    public function destroy(Request $request)
    {
        try {
            $idModuls = $request->input('moduls_id');
            $idUsuari = $request->input('usuaris_id');
            $usuario = Usuaris::findOrFail($idUsuari);
            $moduls = Moduls::findOrFail($idModuls);

            $usuario->moduls()->detach($moduls);


            $mensaje = 'Usuario desmatriculado del módulo';
            $status = 200;
        } catch (QueryException $ex) {
            $mensaje = Utilitat::errorMessage($ex);
            $status = 400;
        }

        return response()->json(['mensaje' => $mensaje], $status);
    }
}
