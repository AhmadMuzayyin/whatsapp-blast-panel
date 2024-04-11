<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeviceSelected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $selectedDevice = session('device') ?? null;
        if ($selectedDevice === null) {
            return redirect()->route('dashboard')->with('error', 'Please select a device first');
        }
        return $next($request);
    }
}
