@extends('layouts.app')

@section('title', 'Eliminar Proyecto')

@section('contenido')
<h2>Eliminar Proyecto</h2>

<p>Seguro que deseas eliminar el proyecto "{{ $proyecto->nombre }}"? Esta accion no se puede deshacer.</p>

<form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="boton-eliminar">Si, Eliminar</button>
    <a href="{{ route('proyectos.index') }}">Cancelar</a>
</form>
@endsection
