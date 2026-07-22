@extends('layouts.app')

@section('title', 'Agregar Proyecto')

@section('contenido')
<h2>Agregar Proyecto</h2>

@if($errors->any())
<div class="mensaje-error">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('proyectos.store') }}" method="POST" class="formulario">
    @csrf

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">

    <label for="fecha_inicio">Fecha de Inicio</label>
    <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}">

    <label for="estado">Estado</label>
    <input type="text" id="estado" name="estado" value="{{ old('estado') }}">

    <label for="responsable">Responsable</label>
    <input type="text" id="responsable" name="responsable" value="{{ old('responsable') }}">

    <label for="monto">Monto</label>
    <input type="number" step="0.01" min="0.01" id="monto" name="monto" value="{{ old('monto') }}">

    <button type="submit">Guardar Proyecto</button>
</form>
@endsection
