<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProyectoWebController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::all();
        return view('proyectos.index', ['proyectos' => $proyectos]);
    }

    public function create()
    {
        return view('proyectos.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'fecha_inicio' => 'required|date',
            'estado' => 'required',
            'responsable' => 'required',
            'monto' => 'required|numeric|gt:0',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'fecha_inicio.required' => 'El campo fecha de inicio es obligatorio.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'estado.required' => 'El campo estado es obligatorio.',
            'responsable.required' => 'El campo responsable es obligatorio.',
            'monto.required' => 'El campo monto es obligatorio.',
            'monto.numeric' => 'El monto debe ser un número válido.',
            'monto.gt' => 'El monto debe ser un valor mayor a cero.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('proyectos.create')
                ->withErrors($validator)
                ->withInput();
        }

        Proyecto::create($request->only([
            'nombre', 'fecha_inicio', 'estado', 'responsable', 'monto',
        ]));

        return redirect()->route('proyectos.index')->with('mensaje', 'Proyecto creado exitosamente.');
    }

    public function show($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view('proyectos.show', ['proyecto' => $proyecto]);
    }

    public function edit($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view('proyectos.edit', ['proyecto' => $proyecto]);
    }

    public function update(Request $request, $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'fecha_inicio' => 'required|date',
            'estado' => 'required',
            'responsable' => 'required',
            'monto' => 'required|numeric|gt:0',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'fecha_inicio.required' => 'El campo fecha de inicio es obligatorio.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'estado.required' => 'El campo estado es obligatorio.',
            'responsable.required' => 'El campo responsable es obligatorio.',
            'monto.required' => 'El campo monto es obligatorio.',
            'monto.numeric' => 'El monto debe ser un número válido.',
            'monto.gt' => 'El monto debe ser un valor mayor a cero.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('proyectos.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $proyecto->update($request->only([
            'nombre', 'fecha_inicio', 'estado', 'responsable', 'monto',
        ]));

        return redirect()->route('proyectos.index')->with('mensaje', 'Proyecto actualizado exitosamente.');
    }

    public function confirmarEliminar($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view('proyectos.eliminar', ['proyecto' => $proyecto]);
    }

    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();

        return redirect()->route('proyectos.index')->with('mensaje', 'Proyecto eliminado exitosamente.');
    }
}
