<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class Authenticate extends Middleware
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        return $next($request,$guards);
    }
}
