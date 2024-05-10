<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Usuaris; // Importa el modelo de usuarios
use App\Models\Moduls; // Importa el modelo de módulos

class MatriculaController extends Controller
{
    public function matricular(Request $request, Usuaris $usuario, Moduls $modulo)
    {
        // Matricular al usuario en el módulo
        $usuario->moduls()->attach($modulo->id);

        return response()->json(['mensaje' => 'Usuario matriculado en el módulo']);
    }

    public function desmatricular(Request $request, Usuaris $usuario, Moduls $modulo)
    {
        // Desmatricular al usuario del módulo
        $usuario->moduls()->detach($modulo->id);

        return response()->json(['mensaje' => 'Usuario desmatriculado del módulo']);
    }
}
