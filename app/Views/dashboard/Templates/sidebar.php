<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="#" class="brand-link">
            <!--begin::Brand Image-->
            <img src="/assets/admin/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">NutsyPOS</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> <a href="<?php echo $menu_activo == 'dashboard' ? '#' : base_url('dashboard'); ?>" class="nav-link <?php echo $menu_activo == 'enlaces' ? 'active' : ''; ?>"> <i class="nav-icon bi bi-link-45deg"></i>
                        <p>Panel</p>
                    </a> </li>
                <li class="nav-header">Productos</li>
                <li class="nav-item"> <a href="<?php echo $menu_activo == 'productos' ? '#' : base_url('dashboard/productos'); ?>" class="nav-link <?php echo $menu_activo == 'productos' ? 'active' : ''; ?>"> <i class="nav-icon bi bi-columns-gap"></i>
                        <p>Productos</p>
                    </a> </li>
                <li class="nav-item">
                    <a href="<?php echo $menu_activo == 'nuevo_producto' ? '#' : base_url('dashboard/nuevoproducto'); ?>" class="nav-link <?php echo $menu_activo == 'nuevo_producto' ? 'active' : ''; ?>"> <i class="nav-icon bi bi-columns-gap"></i>
                        <p>Nuevo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $menu_activo == 'verventas' ? '#' : base_url('dashboard/verventas'); ?>" class="nav-link <?php echo $menu_activo == 'verventas' ? 'active' : ''; ?>"> <i class="nav-icon bi bi-columns-gap"></i>
                        <p>Ver Ventas</p>
                    </a>
                </li>

                <li class="nav-header">Inventario</li>
                <li class="nav-item">
                    <a href="<?php echo $menu_activo == 'ver_inventario' ? '#' : base_url('dashboard/verinventario'); ?>" class="nav-link <?php echo $menu_activo == 'ver_inventario' ? 'active' : ''; ?>"> <i class="nav-icon bi bi-columns-gap"></i>
                        <p>Ver Inventario</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $menu_activo == 'agregar_ingreso' ? '#' : base_url('dashboard/agregaringreso'); ?>" class="nav-link <?php echo $menu_activo == 'agregar_ingreso' ? 'active' : ''; ?>"> <i class="nav-icon bi bi-columns-gap"></i>
                        <p>Agregar</p>
                    </a>
                </li>

                <li class="nav-header">Tienda</li>

                <li class="nav-item"> <a href="<?php echo $menu_activo == 'tienda' ? '#' : base_url('dashboard/pos'); ?>" class="nav-link <?php echo $menu_activo == 'tienda' ? 'active' : ''; ?>"> <i class="nav-icon bi bi-shop"></i>
                        <p>Tienda
                        </p>
                    </a> </li>
                </li>
                <?php
                if ($is_admin) {
                ?>
                    <li class="nav-header">Administrador</li>
                    <li class="nav-item">
                        <a href="<?php echo $menu_activo == 'verusuarios' ? '#' : base_url('dashboard/verusuarios'); ?>" class="nav-link <?php echo $menu_activo == 'verusuarios' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-people"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $menu_activo == 'nuevousuario' ? '#' : base_url('dashboard/nuevousuario'); ?>" class="nav-link <?php echo $menu_activo == 'nuevousuario' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-people"></i>
                            <p>Nuevo Usuario</p>
                        </a>
                    </li>
                <?php
                }
                ?>

            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar-->