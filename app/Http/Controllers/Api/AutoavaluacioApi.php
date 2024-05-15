<?php

namespace App\Http\Controllers\Api;

use App\Models\Moduls;
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
        // Utiliza el ID recibido para buscar los módulos matriculados por el usuario
        $modulos = Moduls::whereHas('matriculas', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->get();

        return response()->json(['modulos' => $modulos]);
    }

    public function update(Request $request, $id)
    {
        // Aquí puedes definir la lógica para la función update si es necesario
    }

    public function destroy($id)
    {
        // Aquí puedes definir la lógica para la función destroy si es necesario
    }
}
