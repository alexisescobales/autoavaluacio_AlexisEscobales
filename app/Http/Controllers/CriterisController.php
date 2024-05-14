<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Clases\Utilitat;
use App\Http\Controllers\Controller;
use App\Models\CriterisAvaluacio;
use Illuminate\Database\QueryException;
use App\Http\Resources\CriterisResource;

class CriterisController extends Controller
{

    public function index()
    {
        $resultats = CriterisAvaluacio::all();
        return CriterisResource::collection($resultats);
    }

    public function store(Request $request)
    {
        $criteris = new CriterisAvaluacio();

        // ERROR EN LOS INPUTS
        $criteris->ordre = $request->input('ordre');
        $criteris->descripcio = $request->input('descripcio');
        $criteris->actiu = $request->input('actiu');
        $criteris->resultats_aprenentatge_id = $request->input('resultats_aprenentatge_id');

        try {
            $criteris->save();
            $response = (new CriterisResource($criteris))
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

    public function show(CriterisAvaluacio $criterisAvaluacio)
    {
        return new CriterisResource($criterisAvaluacio);
    }

    public function update(Request $request, $id)
    {
        $criteris = CriterisAvaluacio::findOrFail($id);

        // ERROR EN LOS INPUTS
        $criteris->ordre = $request->input('ordre');
        $criteris->descripcio = $request->input('descripcio');
        $criteris->actiu = $request->input('actiu');
        $criteris->resultats_aprenentatge_id = $request->input('resultats_aprenentatge_id');


        try {
            $criteris->save();
            $response = (new CriterisResource($criteris))
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
            $criteris = CriterisAvaluacio::findOrFail($id);
            $criteris->delete();
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
