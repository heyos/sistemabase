<div class="sticky-wrapper">
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow navbar-brand-center" role="navigation" data-menu="menu-wrapper">
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                {{-- <li class="nav-item">
                    <a href="index.php?action=inicio" class="nav-link"><i class="la la-home"></i><span>Inicio {{is_root()}} </span></a>
                </li> --}}
                <?php $data = menudata(); ?>
                @foreach ($data as $menu)
                    <li class="nav-item">
                        <a href="{{ url($menu->slug) }}" class="nav-link">
                            <i class="{{ $menu->icono }}"></i><span> {{ $menu->nombre }}</span>
                        </a>
                    </li>
                @endforeach
                
                {{-- <li class=" nav-item"><a href="index.php?action=pdv" class="nav-link"><i class="la la-money"></i><span> PDV</span></a></li>
        
                <li class=" nav-item"><a href="index.php?action=productos" class="nav-link"><i class="la la-archive"></i><span> Productos</span></a></li>
        
                <li class=" nav-item"><a href="index.php?action=sucursal" class="nav-link"><i class="la la-building"></i><span> Sucursal</span></a></li>
        
                <li class="dropdown nav-item" data-menu="dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="la la-user-plus"></i><span>Personas</span></a>
                    <ul class="dropdown-menu">
            
                        <li data-menu="">
                            <a href="index.php?action=clientes" class="dropdown-item" data-toggle="dropdown">Clientes</a>
                        </li>
                
                        <li data-menu="">
                            <a href="index.php?action=proveedores" class="dropdown-item" data-toggle="dropdown">Proveedores</a>
                        </li>
                
                    </ul>
                </li>
            
                <li class=" nav-item"><a href="index.php?action=ventas" class="nav-link"><i class="la la-cart-plus"></i><span> Ventas</span></a></li>
        
                <li class=" nav-item"><a href="index.php?action=gastos" class="nav-link"><i class="la la-usd"></i><span> Gastos</span></a></li>
        
                <li class="dropdown nav-item" data-menu="dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="la la-bookmark-o"></i><span>Categorias</span></a>
                    <ul class="dropdown-menu">
            
                        <li data-menu="">
                            <a href="index.php?action=categoria_producto" class="dropdown-item" data-toggle="dropdown">Categoria Producto</a>
                        </li>
                
                        <li data-menu="">
                            <a href="index.php?action=categoria_gasto" class="dropdown-item" data-toggle="dropdown">Categoria Gasto</a>
                        </li>
                
                    </ul>
                </li>
            
                <li class="dropdown nav-item" data-menu="dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="la la-users"></i><span>Usuarios</span></a>
                    <ul class="dropdown-menu">
            
                        <li data-menu="">
                            <a href="index.php?action=rol_usuario" class="dropdown-item" data-toggle="dropdown">Rol Usuario</a>
                        </li>
                
                        <li data-menu="">
                            <a href="index.php?action=registrar_usuarios" class="dropdown-item" data-toggle="dropdown">Registrar Usuarios</a>
                        </li>
                
                        <li data-menu="">
                            <a href="index.php?action=buscar_usuarios" class="dropdown-item" data-toggle="dropdown">Buscar Usuarios</a>
                        </li>
                
                    </ul>
                </li>
            
                <li class="dropdown nav-item" data-menu="dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="la la-cogs"></i><span>Configuracion</span></a>
                    <ul class="dropdown-menu">
            
                        <li data-menu="">
                            <a href="index.php?action=empresa" class="dropdown-item" data-toggle="dropdown">Empresa</a>
                        </li>
                
                        <li data-menu="">
                            <a href="index.php?action=configurar_sistema" class="dropdown-item" data-toggle="dropdown">Configurar Sistema</a>
                        </li>
                
                        <li data-menu="">
                            <a href="index.php?action=ordenar_menu" class="dropdown-item" data-toggle="dropdown">Ordenar Menu</a>
                        </li>
                
                        <li data-menu="">
                            <a href="index.php?action=ordenar_submenu" class="dropdown-item" data-toggle="dropdown">Ordenar Submenu</a>
                        </li>
                
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
</div>