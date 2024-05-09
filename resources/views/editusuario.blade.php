@extends('principal')

@section('contenido_principal')
<h1>Editar Usuario</h1>

<form action="{{ route('usuarios.update', $usuaris->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nom_usuari">Nombre de Usuario</label>
        <input type="text" class="form-control" id="nom_usuari" name="nom_usuari" value="{{ $usuaris->nom_usuari }}" required>
    </div>
    <div class="form-group">
        <label for="correu">Correo Electrónico</label>
        <input type="email" class="form-control" id="correu" name="correu" value="{{ $usuaris->correu }}" required>
    </div>
    <div class="form-group">
        <label for="nom">Nombre</label>
        <input type="text" class="form-control" id="nom" name="nom" value="{{ $usuaris->nom }}" required>
    </div>
    <div class="form-group">
        <label for="cognom">Apellido</label>
        <input type="text" class="form-control" id="cognom" name="cognom" value="{{ $usuaris->cognom }}" required>
    </div>
    <div class="form-group">
        <label for="contrasenya">Contraseña</label>
        <input type="password" class="form-control" id="contrasenya" name="contrasenya" value="{{ $usuaris->contrasenya }}" required>
    </div>
    <div class="form-group">
        <label for="actiu">Activo</label>
        <select class="form-control" id="actiu" name="actiu" required>
            <option value="1" {{ $usuaris->actiu == 1 ? 'selected' : '' }}>Activo</option>
            <option value="0" {{ $usuaris->actiu == 0 ? 'selected' : '' }}>Inactivo</option>
        </select>
    </div>
    <div class="form-group">
        <label for="tipus_usuaris_id">Tipo de Usuario</label>
        <select class="form-control" id="tipus_usuaris_id" name="tipus_usuaris_id" required>
            @foreach ($tipos as $tipo)
            <option value="{{ $tipo->id }}" @if ($tipo->id == $usuaris->tipus_usuaris_id) selected @endif>{{ $tipo->tipus }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
</form>
@endsection
