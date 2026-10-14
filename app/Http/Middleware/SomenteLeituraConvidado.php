<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SomenteLeituraConvidado
{
    /**
     * Usuários do tipo "convidado" só podem consultar o sistema: qualquer requisição
     * que não seja de leitura (POST/PUT/PATCH/DELETE) e as telas de formulário
     * de criação/edição são bloqueadas. O logout continua liberado.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $usuario = $request->user();

        if ($usuario && $usuario->isConvidado() && ! $request->routeIs('login.destroy')) {
            $leitura = $request->isMethodSafe();
            $formulario = $request->routeIs('*.create', '*.edit');

            if (! $leitura || $formulario) {
                abort(403, 'Perfil convidado: acesso somente para visualização.');
            }
        }

        return $next($request);
    }
}
