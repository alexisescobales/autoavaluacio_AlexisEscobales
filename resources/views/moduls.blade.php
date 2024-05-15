@extends('principal')

@section('contenido_principal')
    <div id="moduls" data-usuario="{{ json_encode($usuario) }}"></div>
@endsection
