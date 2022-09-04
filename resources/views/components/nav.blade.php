<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
            @foreach ($items as $item )
            <li class="nav-item menu-open">
                <a href="#" class="nav-link {{$item['route'] == $active? 'active' : ''}}">
                    <i class="{{$item['icon']}}"></i>
                    <p>
                        {{$item['title']}}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route($item['route'])}}" class="nav-link {{$item['route'] == $active? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{$item['title1']}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route($item['route2'])}}" class="nav-link {{$item['route2'] == $active? 'active' : ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{$item['title2']}}</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endforeach

        </ul>
    </nav>
