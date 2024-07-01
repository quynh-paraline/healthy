<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class FilterRoleOrdersAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->to(route("admin.login"));
        }

        $u = auth()->user();

        if ($u->role != 1 && $u->role != 2) {
            return redirect()->to(route("web.welcome"));
        }
        $route = Route::currentRouteName();
        $a = explode(".", $route);

        if (($a[1] == 'products' || $a[1] == 'administrators' || $a[1] == 'categories') && ($a[2] == 'create' || $a[2] == 'edit' || $a[2] == 'delete') && $u->role != 1) {
            return redirect()->to(route("admin.dashboard"));
        }

        return $next($request);
    }
}
