@extends('layouts.app')

@section('title', 'Detalle del Proyecto')

@section('contenido')
<h2>Detalle del Proyecto</h2>

<div class="detalle-proyecto">
    <p><strong>ID:</strong> {{ $proyecto->id }}</p>
    <p><strong>Nombre:</strong> {{ $proyecto->nombre }}</p>
    <p><strong>Fecha de Inicio:</strong> {{ substr($proyecto->fecha_inicio, 0, 10) }}</p>
    <p><strong>Estado:</strong> {{ $proyecto->estado }}</p>
    <p><strong>Responsable:</strong> {{ $proyecto->responsable }}</p>
    <p><strong>Monto:</strong> $ {{ number_format($proyecto->monto, 2, ',', '.') }}</p>
</div>

<p class="acciones">
    <a href="{{ route('proyectos.edit', $proyecto->id) }}">Editar</a>
    <a href="{{ route('proyectos.index') }}">Volver al listado</a>
</p>
@endsection
