<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AutoavaluacioController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            return response()->json($user);
        } else {
            return response()->json(['message' => 'No hay usuario autenticado'], 401);
        }
    }
    

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
