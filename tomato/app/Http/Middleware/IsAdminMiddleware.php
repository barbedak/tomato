<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        dd($request->route()->getName());
        if (!auth()->user()->is_admin){
            return response([
                'message'=>'forbidden',
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
