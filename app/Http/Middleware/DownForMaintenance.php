<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DownForMaintenance
{
    /**
     * Display the maintenance page when maintenance mode is enabled.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $maintenanceEnabled = app()->isDownForMaintenance()
            || (bool) config('app.down_for_maintenance', false);

        if ($maintenanceEnabled && ! $request->routeIs('maintenance')) {
            return response()->view('maintenance', status: 503);
        }

        return $next($request);
    }
}
