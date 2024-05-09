<?php

namespace App\Http\Controllers;

use App\Models\Usuaris;
use App\Models\TipusUsuaris;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los usuarios desde la base de datos
        $usuarios = Usuaris::all();

        return view('usuarios', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = TipusUsuaris::all();

        return view('createusuario', compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new Usuaris();

        // ERROR EN LOS INPUTS
        $usuario->nom_usuari = $request->input['nom_usuari'];
        $usuario->contrasenya = bcrypt($request->input['contrasenya']);
        $usuario->correu = $request->input['correu'];
        $usuario->nom = $request->input['nom'];
        $usuario->cognom = $request->input['cognom'];
        $usuario->tipus_usuaris_id = $request->input['tipus_usuaris_id'];
        $usuario->actiu = 1;

        
        $usuario->save();



        // Redireccionar al usuario a la lista de usuarios
        return redirect()->action([UsuarioController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuaris  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function show(Usuaris $usuaris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuaris  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuaris $usuaris)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuaris  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuaris $usuaris)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuaris  $usuaris
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuaris $usuaris)
    {
        //
    }
}
