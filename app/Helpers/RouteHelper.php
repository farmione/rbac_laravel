<?php 

namespace App\Helpers;


class RouteHelper 
{
    public static function getRoute($menuRoute)
    {
        $routeMap = [
            'show_user' => 'users.show',
            'edit_user' => 'users.edit',
            'list_users' => 'users.index',
        ];

        return $routeMap[$menuRoute];
    }
}