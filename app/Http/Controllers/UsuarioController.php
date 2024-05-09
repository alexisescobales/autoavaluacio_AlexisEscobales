<?php

namespace App\Http\Controllers;

use App\Models\Usuaris;
use App\Models\TipusUsuaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios desde la base de datos
        $usuarios = Usuaris::all();

        return view('usuarios', compact('usuarios'));
    }




    public function create()
    {
        $tipos = TipusUsuaris::all();

        return view('createusuario', compact('tipos'));
    }






    public function store(Request $request)
    {
        $usuario = new Usuaris();

        // ERROR EN LOS INPUTS
        $usuario->nom_usuari = $request->input('nom_usuari');
        $usuario->contrasenya = bcrypt($request->input('contrasenya'));
        $usuario->correu = $request->input('correu');
        $usuario->nom = $request->input('nom');
        $usuario->cognom = $request->input('cognom');
        $usuario->tipus_usuaris_id = $request->input('tipus_usuaris_id');
        $usuario->actiu = 1;
        $usuario->save();

        // Redireccionar al usuario a la lista de usuarios
        return redirect()->action([UsuarioController::class, 'index']);
    }





    public function show(Usuaris $usuaris)
    {
        
    }





    public function edit(Usuaris $usuaris, $id)
{
    // Obtener los tipos de usuarios para el formulario
    $tipos = TipusUsuaris::all();

    $usuaris = Usuaris::find($id);

    // Retornar la vista de edición con los datos del usuario
    return view('editusuario', compact('usuaris', 'tipos'));
}

public function update(Request $request, Usuaris $usuaris, $id)
{
    // Validar los datos del formulario
    $request->validate([
        'nom_usuari' => 'required|unique:usuaris,nom_usuari,'.$id,
        'correu' => 'required|email|unique:usuaris,correu,'.$id,
        'nom' => 'required',
        'cognom' => 'required',
        'tipus_usuaris_id' => 'required',
        'actiu' => 'required', // Asegúrate de que este campo sea requerido si es necesario
    ]);

    // Buscar el usuario por su ID
    $usuaris = Usuaris::find($id);

    // Actualizar los datos del usuario, excluyendo la contraseña
    $usuaris->update($request->except('contrasenya'));

    // Actualizar la contraseña si se proporciona un nuevo valor
    if ($request->has('contrasenya')) {
        $usuaris->update([
            'contrasenya' => bcrypt($request->contrasenya)
        ]);
    }

    // Redireccionar al usuario a la lista de usuarios
    return redirect()->route('usuarios.index');
}



    public function destroy(Usuaris $usuario)
    {
        // Eliminar el usuario
        $usuario->delete();

        // Redireccionar al usuario a la lista de usuarios
        return redirect()->route('usuarios.index');
    }

    public function showLoginForm()
    {
        return view('login'); // Suponiendo que tienes una vista llamada 'login.blade.php'
    }

    public function login(Request $request)
    {
        $nom_usuari = $request->input('nom_usuari');
        $contrasenya = $request->input('contrasenya');

        $user = Usuaris::where('nom_usuari', $nom_usuari)->first();

        if ($user != null && Hash::check($contrasenya, $user->contrasenya)){
            Auth::login($user);
            $reponse = redirect('/principal');
        }else{
            $request->session()->flash('error', 'Usuari o contrasenya incorrectes');
            $reponse = redirect('/login')->withInput();
        }

        return $reponse;
    }

    public function logout()
    {
        Auth::logout();
        return view('principal');
    }
}
