<?php

namespace App\Http\Controllers\Middleware;
use App\Http\Controllers\Controller;
use Closure;

class OnlyAdmin extends Controller
{
    public function handle($request, Closure $next)
{
    if ($request->user()->role !== 'admin') {
        return response()->json(['message' => 'Forbidden'], 403);
    }

    return $next($request);
}

}
