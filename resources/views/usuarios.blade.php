@extends('principal')

@section('contenido_principal')
<h1>Lista de Usuarios</h1>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Activo</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->id }}</td>
            <td>{{ $usuario->nom_usuari }}</td>
            {{-- <td>{{ $usuario->contrasenya }}</td> --}}
            <td>{{ $usuario->correu }}</td>
            <td>{{ $usuario->nom }}</td>
            <td>{{ $usuario->cognom }}</td>
            <td>{{ $usuario->actiu }}</td>
            <td>{{ $usuario->tipus_usuaris_id }}</td>
            <td>
                <button class="btn btn-success">Editar</button>
                <button class="btn btn-danger">Eliminar</button>
            </td>
        </tr>
        @endforeach
    </tbody>
    <a href="{{ url('usuarios/create') }}" class="btn btn-danger">Crear Usuario</a>

</table>
@endsection


<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f2f2f2;
    }

    .btn {
        padding: 6px 10px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }

    .btn-editar {
        background-color: #4CAF50;
        color: white;
    }

    .btn-eliminar {
        background-color: #f44336;
        color: white;
    }
</style>