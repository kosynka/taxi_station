<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (auth()->user()->role == 'manager') {
            $permission = Permission::where('name', $permission)->first();

            if ($permission->is_active) {
                return $next($request);
            }

            return redirect()->back()->with(['error' => 'У вас нет на это прав']);
        }
    }
}
