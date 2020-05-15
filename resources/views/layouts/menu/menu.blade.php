<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item"><a href="index.html"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="dashboard-ecommerce.html" data-i18n="nav.dash.ecommerce">eCommerce</a>
            </li>
            <li><a class="menu-item" href="dashboard-crypto.html" data-i18n="nav.dash.crypto">Crypto</a>
            </li>
            <li><a class="menu-item" href="dashboard-sales.html" data-i18n="nav.dash.sales">Sales</a>
            </li>
          </ul>
        </li>
        
        <li class=" nav-item">
            <a href="changelog.html">
                <i class="la la-copy"></i><span class="menu-title" data-i18n="">Changelog</span>
            </a>
        </li>

        <?php $data = menudata(); ?>
        @foreach ($data as $menu)
            <li class="nav-item">
                <a href="{{ url($menu->slug) }}" class="nav-link">
                    <i class="{{ $menu->icono }}"></i><span> {{ $menu->nombre }}</span>
                </a>
            </li>
        @endforeach

        
      </ul>
    </div>
  </div>