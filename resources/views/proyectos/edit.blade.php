@extends('layouts.app')

@section('title', 'Editar Proyecto')

@section('contenido')
<h2>Editar Proyecto</h2>

@if($errors->any())
<div class="mensaje-error">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST" class="formulario">
    @csrf
    @method('PUT')

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $proyecto->nombre) }}">

    <label for="fecha_inicio">Fecha de Inicio</label>
    <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', substr($proyecto->fecha_inicio, 0, 10)) }}">

    <label for="estado">Estado</label>
    <input type="text" id="estado" name="estado" value="{{ old('estado', $proyecto->estado) }}">

    <label for="responsable">Responsable</label>
    <input type="text" id="responsable" name="responsable" value="{{ old('responsable', $proyecto->responsable) }}">

    <label for="monto">Monto</label>
    <input type="number" step="0.01" min="0.01" id="monto" name="monto" value="{{ old('monto', $proyecto->monto) }}">

    <button type="submit">Actualizar Proyecto</button>
</form>
@endsection
