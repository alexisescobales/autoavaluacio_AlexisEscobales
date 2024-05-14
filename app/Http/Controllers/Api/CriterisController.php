<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilitat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ResultatsAprenentatge;
use Illuminate\Database\QueryException;
use App\Http\Resources\ResultatsResource;

class CriterisController extends Controller
{
    public function index()
    {
        $resultats = ResultatsAprenentatge::all();
        return ResultatsResource::collection($resultats);
    }

    public function store(Request $request)
    {
        $resultats = new ResultatsAprenentatge();

        // ERROR EN LOS INPUTS
        $resultats->ordre = $request->input('ordre');
        $resultats->descripcio = $request->input('descripcio');
        $resultats->actiu = $request->input('actiu');
        $resultats->moduls_id = $request->input('moduls_id');

        try {
            $resultats->save();
            $response = (new ResultatsResource($resultats))
                ->response()
                ->setStatusCode(201);
        } catch (QueryException $ex) {
            $mensaje = Utilitat::errorMessage($ex);
            $response = \response()
                ->json(['error' => $mensaje], 400);
        }




        // Redireccionar al usuario a la lista de usuarios
        return $response;
    }

    public function show(ResultatsAprenentatge $resultatsAprenentatge)
    {
        return new ResultatsResource($resultatsAprenentatge);
    }

    public function update(Request $request, $id)
    {
        $resultatsAprenentatge = ResultatsAprenentatge::findOrFail($id);

        // ERROR EN LOS INPUTS
        $resultatsAprenentatge->ordre = $request->input('ordre');
        $resultatsAprenentatge->descripcio = $request->input('descripcio');
        $resultatsAprenentatge->actiu = $request->input('actiu');
        $resultatsAprenentatge->moduls_id = $request->input('moduls_id');


        try {
            $resultatsAprenentatge->save();
            $response = (new ResultatsResource($resultatsAprenentatge))
                ->response()
                ->setStatusCode(201);
        } catch (QueryException $ex) {
            $mensaje = Utilitat::errorMessage($ex);
            $response = \response()
                ->json(['error' => $mensaje], 400);
        }

        return $response;
    }

    public function destroy($id)
    {
        try {
            $resultatsAprenentatge = ResultatsAprenentatge::findOrFail($id);
            $resultatsAprenentatge->delete();
            $response = \response()
                ->json(['mensaje' => 'Registro borrado'], 200);
        } catch (QueryException $ex) {
            $mensaje = Utilitat::errorMessage($ex);
            $response = \response()
                ->json(['error' => $mensaje], 400);
        }
        return $response();
    }

}
