<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        // Convertimos la lista de roles a un array
        $rolesArray = explode('|', $roles);

        // Comprobamos si el usuario tiene al menos uno de los roles
        foreach ($rolesArray as $role) {
            if ($request->user()->hasRole($role)) {
                return $next($request);
            }
        }

        // Si el usuario no tiene ninguno de los roles, lo redirigimos
        return redirect('dashboard');
    }
}
