<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCustomerNavarro
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            return redirect()->route('login.navarro')
                ->with('error', 'Please log in to continue.');
        }

        if (! auth()->user()->isCustomer()) {
            abort(403, 'Access denied. Customers only.');
        }

        return $next($request);
    }
}