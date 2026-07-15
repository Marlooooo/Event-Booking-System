<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureBookingStepNavarro
{
    protected array $requirements = [
        'details'      => 'booking.customerName',
        'confirmation' => 'booking.details',
        'summary'      => 'booking.confirmation',
    ];

    public function handle(Request $request, Closure $next, string $step): Response
    {
        $requiredSessionKey = $this->requirements[$step] ?? null;

        if ($requiredSessionKey && ! session()->has($requiredSessionKey)) {
            return redirect()
                ->route('booking.start')
                ->with('error', 'Please complete the previous step before continuing.');
        }

        return $next($request);
    }
}