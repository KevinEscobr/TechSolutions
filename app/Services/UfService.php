<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class UfService
{
    public function obtenerUfDelDia(): array
    {
        $valorBase = 38245.67;
        $variacion = mt_rand(-50, 50) / 100;
        $valor = round($valorBase + $variacion, 2);

        return [
            'valor' => $valor,
            'fecha' => Carbon::now()->format('d-m-Y'),
        ];
    }
}
