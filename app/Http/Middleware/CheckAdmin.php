<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Gere o pedido de entrada.
     * Verifica se o utilizador está autenticado e se é administrador.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Se não estiver logado ou não for tipo admin (1), bloqueia o acesso
        if (!Auth::check() || Auth::user()->user_type != 1) {
            abort(403, 'Acesso negado. Apenas administradores podem aceder a esta área.');
        }

        return $next($request);
    }
}
