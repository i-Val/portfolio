<?php

namespace App\Http\Middleware;

use App\Models\Profile;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class EnsureSiteNotInMaintenance
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()) {
            return $next($request);
        }

        if ($request->routeIs('login', 'password.*', 'register', 'verification.*')) {
            return $next($request);
        }

        if (! Schema::hasTable('profiles')) {
            return $next($request);
        }

        $profile = Profile::query()->first();
        if (! $profile || ! $profile->maintenance_enabled) {
            return $next($request);
        }

        return response()->view('maintenance', [
            'maintenanceMessage' => $profile->maintenance_message,
        ], 503);
    }
}
