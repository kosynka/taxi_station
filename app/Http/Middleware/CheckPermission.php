<?php

namespace App\Http\Middleware;

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
    public function handle(Request $request, Closure $next, string $permission = ''): Response
    {
        $user = auth()->user();

        if ($user->role !== 'admin') {
            $requestName = $request->route()->getName();
            $permission = $user->permissions[$requestName];

            if ($permission === true) {
                return $next($request);
            }

            $requestNameParts = explode('.', $requestName);
            $firstPart = $requestNameParts[0];

            $message = 'У вас нет прав на ' . $user->getPermissionText($requestName);

            return redirect()->route($firstPart . '.index')->withErrors(['msg' => $message]);
        }

        return $next($request);
    }
}
