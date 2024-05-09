@extends('principal')

@section('contenido_principal')
<div class="container">
    <h2>Iniciar sesión</h2>
    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ action([App\Http\Controllers\UsuarioController::class, 'login']) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom_usuari">Nombre Usuario</label>
            <input type="text" id="nom_usuari" name="nom_usuari" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="contrasenya">Contraseña</label>
            <input type="password" id="contrasenya" name="contrasenya" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    </form>
</div>
@endsection
