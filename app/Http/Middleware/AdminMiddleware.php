<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        if ($user && $user->isAdmin()) {
            return $next($request);
        }
        return response()->json(['message' => 'Vous n\'avez pas les autorisations nécessaires.'], 403);
    }

}
