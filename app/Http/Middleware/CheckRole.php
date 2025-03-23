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
        // Los roles del usuario pasan a ser un array
        $rolesUser = explode('|', $roles);

        // Compruebo si el usuario tiene alguno de los roles
        foreach ($rolesUser as $role) {
            if ($request->user()->hasRole($role)) {
                return $next($request);
            }
        }
        return redirect('dashboard');
    }
}
