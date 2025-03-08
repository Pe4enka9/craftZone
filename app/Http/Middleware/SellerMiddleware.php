<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role->name !== 'seller') {
            return response()->json([], 403);
        }

        return $next($request);
    }
}
