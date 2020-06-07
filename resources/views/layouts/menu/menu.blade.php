<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        
        @php
            $data = menudata();
            $hasSub = '';
            // $url = actionRouteName();
            // dd($data);
        @endphp
        @foreach ($data as $menu)
            @php
                $sub = $menu['sub'];
                $contSub = count($menu['sub']);
                $hasSub = $contSub > 0 ? 'has-sub':'';
            @endphp
            <li class="nav-item {{ $hasSub }}">
                <a href="{{ url($menu['slug']) }}">
                    <i class="{{ $menu['icono'] }}"></i><span> {{ $menu['nombre'] }}</span>
                    @if ($contSub > 0)
                        <ul class="menu-content">
                            @foreach ($sub as $submenu)
                                <li>
                                    <a class="menu-item" href="{{ $submenu['slug'] }}" >{{ $submenu['nombre'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </a>
            </li>
        @endforeach

        
      </ul>
    </div>
  </div>