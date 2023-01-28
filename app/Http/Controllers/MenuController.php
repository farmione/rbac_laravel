<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\RouteHelper;

class MenuController extends Controller
{
    use RouteHelper;
    //
    public function __construct() {
        $this->middleware(RoleMiddleware::class);
    }
    public function indexEload() {
        $user = auth()->user;
        $user_roles = $user->roles()->with(['permissions'])->get();
        $user_permissions = [];
        foreach ($user_roles as $role) {
        $user_permissions = array_merge($user_permissions, $role->permissions->pluck('name')->toArray());
        }
        $topbar_menus = Menu::whereIn('permission', $user_permissions)->where('type', 'topbar')->get();
        $sidebar_menus = Menu::whereIn('permission', $user_permissions)->where('type', 'sidebar')->with('submenus')->get();

        return view('menus.index', ['topbar_menus' => $topbar_menus, 'sidebar_menus' => $sidebar_menus]);
    }

    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        $route = RouteHelper::getRoute($menu->route);
        return view('menu.show', compact('route'));
    }

}
