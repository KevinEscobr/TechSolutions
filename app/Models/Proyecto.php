<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

# Representa un Proyecto en el sistema y define que datos se pueden guardar en la base de datos
class Proyecto extends Model
{
    # Lista de campos del proyecto que el sistema tiene permitido llenar y guardar
    protected $fillable = [
        'nombre',       # El nombre descriptivo del proyecto
        'fecha_inicio', # La fecha en que inicia el proyecto
        'estado',       # El estado actual del proyecto (ej. Activo, Pendiente)
        'responsable',  # El nombre de la persona encargada
        'monto'         # El dinero o presupuesto asignado
    ];
}
