<?php

namespace App\View\Components;

use App\Services\UfService;
use Illuminate\View\Component;

class UfHoy extends Component
{
    public $valor;
    public $fecha;

    public function __construct(UfService $ufService)
    {
        $datos = $ufService->obtenerUfDelDia();
        $this->valor = $datos['valor'];
        $this->fecha = $datos['fecha'];
    }

    public function render()
    {
        return view('components.uf-hoy');
    }
}
