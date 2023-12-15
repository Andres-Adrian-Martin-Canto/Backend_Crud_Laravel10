<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     * Valida antes de ir a la ruta que este autenticado
     */
    // Metodo que valida si esta autenticado si no es asi no podra
    // entrar a las rutas
    protected function redirectTo(Request $request): ?string
    {
        // Si no esta autenticado lo envia al login.
        return $request->expectsJson() ? null : route('login');
    }
}
