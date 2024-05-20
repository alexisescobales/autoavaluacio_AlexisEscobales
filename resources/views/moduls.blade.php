@extends('principal')

@section('contenido_principal')
    @if (Auth::check())
        @if (Auth::check() && Auth::user()->tipus_usuaris_id == '2')
            <div id="profes" data-usuario="{{ Auth::user() }}"></div>
        @elseif (Auth::check() && Auth::user()->tipus_usuaris_id == '3')
            <div id="moduls" data-usuario="{{ Auth::user() }}"></div>
        @endif
    @endif
@endsection
