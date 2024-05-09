@extends('principal')

@section('contenido_principal')
<h1>Crear Nuevo Usuario</h1>

<form action="{{ action([App\Http\Controllers\UsuarioController::class, 'store']) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nom_usuari">Nombre de Usuario</label>
        <input type="text" class="form-control" id="nom_usuari" name="nom_usuari" required>
    </div>
    <div class="form-group">
        <label for="contrasenya">Contraseña</label>
        <input type="password" class="form-control" id="contrasenya" name="contrasenya" required>
    </div>
    <div class="form-group">
        <label for="correu">Correo Electrónico</label>
        <input type="email" class="form-control" id="correu" name="correu" required>
    </div>
    <div class="form-group">
        <label for="nom">Nombre</label>
        <input type="text" class="form-control" id="nom" name="nom" required>
    </div>
    <div class="form-group">
        <label for="cognom">Apellido</label>
        <input type="text" class="form-control" id="cognom" name="cognom" required>
    </div>
    <div class="form-group">
        <label for="tipus_usuaris_id">Tipo de Usuario</label>
        <select class="form-control" id="tipus_usuaris_id" name="tipus_usuaris_id" required>
            @foreach ($tipos as $tipo)
            <option value="{{$tipo->id}}">{{$tipo->tipus}}</option>
            @endforeach
        </select>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Crear Usuario</button>
</form>
@endsection
