<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProyectoController extends Controller
{
    # Obtiene y muestra la lista de todos los proyectos guardados en el sistema
    public function index()
    {
        return response()->json([
            'message' => 'Proyectos obtenidos correctamente',
            'data' => Proyecto::all()
        ], 200);
    }

    # Registra un nuevo proyecto en el sistema
    public function store(Request $request)
    {
        # Intenta ajustar la fecha al formato correcto antes de guardarla
        if ($request->has('fecha_inicio')) {
            try {
                $formattedDate = \Illuminate\Support\Carbon::parse($request->fecha_inicio)->format('Y-m-d');
                $request->merge(['fecha_inicio' => $formattedDate]);
            } catch (\Exception $e) {
            }
        }

        # Revisa que no falte informacion obligatoria
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'fecha_inicio' => 'required|date_format:Y-m-d',
            'estado' => 'required',
            'responsable' => 'required',
            'monto' => 'required|numeric|gt:0'
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'fecha_inicio.required' => 'El campo fecha de inicio es obligatorio.',
            'fecha_inicio.date_format' => 'La fecha de inicio debe tener el formato YYYY-MM-DD.',
            'estado.required' => 'El campo estado es obligatorio.',
            'responsable.required' => 'El campo responsable es obligatorio.',
            'monto.required' => 'El campo monto es obligatorio.',
            'monto.numeric' => 'El monto debe ser un número válido.',
            'monto.gt' => 'El monto debe ser un valor mayor a cero.'
        ]);

        # Si falta informacion, responde indicando los errores
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        # Crea y guarda el proyecto con los datos recibidos
        $proyecto = Proyecto::create([
            'nombre' => $request->nombre,
            'fecha_inicio' => $request->fecha_inicio,
            'estado' => $request->estado,
            'responsable' => $request->responsable,
            'monto' => $request->monto,
        ]);

        # Responde confirmando que el proyecto fue creado
        return response()->json([
            'message' => 'Proyecto creado exitosamente',
            'data' => $proyecto
        ], 201);
    }

    # Muestra los datos de un proyecto especifico buscando por su numero identificador
    public function show($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return response()->json([
            'message' => 'Proyecto obtenido correctamente',
            'data' => $proyecto
        ], 200);
    }

    # Modifica los datos de un proyecto existente buscando por su numero identificador
    public function update(Request $request, $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        # Intenta ajustar la fecha si fue enviada
        if ($request->has('fecha_inicio')) {
            try {
                $formattedDate = \Illuminate\Support\Carbon::parse($request->fecha_inicio)->format('Y-m-d');
                $request->merge(['fecha_inicio' => $formattedDate]);
            } catch (\Exception $e) {
            }
        }

        # Valida que los datos enviados sean correctos
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required',
            'fecha_inicio' => 'sometimes|required|date_format:Y-m-d',
            'estado' => 'sometimes|required',
            'responsable' => 'sometimes|required',
            'monto' => 'sometimes|required|numeric|gt:0'
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'fecha_inicio.required' => 'El campo fecha de inicio es obligatorio.',
            'fecha_inicio.date_format' => 'La fecha de inicio debe tener el formato YYYY-MM-DD.',
            'estado.required' => 'El campo estado es obligatorio.',
            'responsable.required' => 'El campo responsable es obligatorio.',
            'monto.required' => 'El campo monto es obligatorio.',
            'monto.numeric' => 'El monto debe ser un número válido.',
            'monto.gt' => 'El monto debe ser un valor mayor a cero.'
        ]);

        # Si hay errores en los datos, responde indicandolos
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        # Guarda los cambios en el proyecto
        $proyecto->update($request->only([
            'nombre',
            'fecha_inicio',
            'estado',
            'responsable',
            'monto'
        ]));

        # Responde confirmando que el proyecto fue actualizado
        return response()->json([
            'message' => 'Proyecto actualizado exitosamente',
            'data' => $proyecto
        ], 200);
    }

    # Borra permanentemente un proyecto del sistema por su numero identificador
    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();

        return response()->json([
            'message' => 'Proyecto eliminado exitosamente'
        ], 200);
    }
}
