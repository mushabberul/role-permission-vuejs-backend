<?php

namespace App\Http\Middleware;

use App\Models\Backend\Permission;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AuthGetMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user) {
            $permissions = Permission::get();
            foreach ($permissions as $permission) {
                Gate::define($permission->permission_slug, function (User $user) use ($permission) {
                    return $user->role->permissions()->where('permission_slug', $permission->permission_slug)->first() ? true : false;
                });
            }
        }

        return $next($request);
    }
}
