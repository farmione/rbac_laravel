<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MenuPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $user = $request->user();
        $userRoles = $user->roles()->with(['permissions'])->get();
        $userPermissions = [];
        foreach ($userRoles as $role) {
            $userPermissions = array_merge($userPermissions, $role->permissions->pluck('name')->toArray());
        }

        $topbarMenus = Menu::whereIn('permission', $userPermissions)->where('type', 'topbar')->get();
        $sidebarMenus = Menu::whereIn('permission', $user_permissions)->where('type', 'sidebar')->with('submenus')->get();

        view()->share(['topbar_menus' => $topbarMenus, 'sidebar_menus' => $sidebarMenus]);

        return $next($request);
    }
}
