<div class="bg-gray-200 p-4">
    <div class="topbar-menu flex justify-between items-center">
        @foreach($topbar_menus as $menu)
            <a href="{{ route(RouteHelper::getRoute($menu->route)) }}" class="text-gray-800 hover:text-blue-500">{{ $menu->name }}</a>
        @endforeach
    </div>

    <div class="sidebar-menu">
        @foreach($sidebar_menus as $menu)
            <a href="{{ route(RouteHelper::getRoute($menu->route)) }}" class="text-gray-800 hover:text-blue-500 block py-2">{{ $menu->name }}</a>
            @if($menu->has('sub_menus'))
                <ul class="pl-8">
                    @foreach($menu->get('sub_menus') as $sub_menu)
                        <li class="py-2"><a href="{{ route(RouteHelper::getRoute($sub_menu->route)) }}" class="text-gray-800 hover:text-blue-500">{{ $sub_menu->name }}</a></li>
                    @endforeach
                </ul>
            @endif
        @endforeach
    </div>
</div>