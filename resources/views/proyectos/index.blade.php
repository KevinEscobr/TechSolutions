@extends('layouts.app')

@section('title', 'Listado de Proyectos')

@section('contenido')
<h2>Listado de Proyectos</h2>

<table class="tabla-proyectos">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Fecha Inicio</th>
            <th>Estado</th>
            <th>Responsable</th>
            <th>Monto</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($proyectos as $proyecto)
        <tr>
            <td>{{ $proyecto->id }}</td>
            <td>{{ $proyecto->nombre }}</td>
            <td>{{ substr($proyecto->fecha_inicio, 0, 10) }}</td>
            <td>{{ $proyecto->estado }}</td>
            <td>{{ $proyecto->responsable }}</td>
            <td>$ {{ number_format($proyecto->monto, 2, ',', '.') }}</td>
            <td class="acciones">
                <a href="{{ route('proyectos.show', $proyecto->id) }}">Ver</a>
                <a href="{{ route('proyectos.edit', $proyecto->id) }}">Editar</a>
                <a href="{{ route('proyectos.confirmarEliminar', $proyecto->id) }}">Eliminar</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">No hay proyectos registrados todavia.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
