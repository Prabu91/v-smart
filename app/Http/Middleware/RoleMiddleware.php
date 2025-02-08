<?php

namespace App\Http\Middleware;

use App\Support\LogHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            abort(403, 'User tidak terautentikasi.');
        }
    
        $userRole = Auth::user()->role;
        
        if ($userRole !== 'super admin') {
            LogHelper::log("User mencoba akses admin: " . Auth::user()->name . " (Role: $userRole)");
            return redirect()->route('dashboard')->with('error', 'Tidak Memiliki Akses.');
        }
    
        return $next($request);
    }
}
