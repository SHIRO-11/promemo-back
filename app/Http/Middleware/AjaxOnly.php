<?php

namespace App\Http\Middleware;

use Closure;

class AjaxOnly
{
    public function handle($request, Closure $next)
    {
        if ($request->ajax()) {
            return $next($request);
        }
        abort(403);
    }
}