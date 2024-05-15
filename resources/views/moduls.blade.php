@extends('principal')

@section('contenido_principal')
    MODULOS

    <div id="moduls" data-usuario="{{ json_encode($usuario) }}"></div>
@endsection
