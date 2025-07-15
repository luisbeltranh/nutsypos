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
                <li class="nav-item"> <a href="<?php echo base_url('dashboard'); ?>" class="nav-link <?php echo $menu_activo == 'enlaces' ? 'active' : ''; ?>"> <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Panel</p>
                    </a> </li>
                <li class="nav-header">Productos</li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-tag"></i>
                        <p>
                            Productos Unidad
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $menu_activo == 'productos' ? '#' : base_url('dashboard/productos'); ?>" class="nav-link <?php echo $menu_activo == 'productos' ? 'active' : ''; ?>">
                                <i class="nav-icon bi bi-columns-gap"></i>
                                <p>Productos</p>
                            </a>
                        </li>
                        <?php
                        if ($is_admin) {
                        ?>
                            <li class="nav-item">
                                <a href="<?php echo $menu_activo == 'nuevo_producto' ? '#' : base_url('dashboard/nuevoproducto'); ?>" class="nav-link <?php echo $menu_activo == 'nuevo_producto' ? 'active' : ''; ?>"> <i class="nav-icon bi bi-columns-gap"></i>
                                    <p>Nuevo Producto</p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="nav-item">
                            <a href="<?php echo $menu_activo == 'ver_inventario' ? '#' : base_url('dashboard/verinventario'); ?>" class="nav-link <?php echo $menu_activo == 'ver_inventario' ? 'active' : ''; ?>">
                                <i class="nav-icon bi bi-columns-gap"></i>
                                <p>Inventario</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-tags"></i>
                        <p>
                            Productos Granel
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $menu_activo == 'productos_granel' ? '#' : base_url('dashboard/verproductosgranel'); ?>" class="nav-link <?php echo $menu_activo == 'productos_granel' ? 'active' : ''; ?>">
                                <i class="nav-icon bi bi-columns-gap"></i>
                                <p>Productos Granel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $menu_activo == 'ver_granel' ? '#' : base_url('dashboard/verinventariogranel'); ?>" class="nav-link <?php echo $menu_activo == 'ver_granel' ? 'active' : ''; ?>">
                                <i class="nav-icon bi bi-columns-gap"></i>
                                <p>Inventario Granel</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $menu_activo == 'agregarembolsadogranel' ? '#' : base_url('dashboard/agregarembolsadogranel'); ?>" class="nav-link <?php echo $menu_activo == 'agregarembolsadogranel' ? 'active' : ''; ?>">
                        <i class="nav-icon bi bi-bag-plus"></i>
                        <p>Embolsar</p>
                    </a>
                </li>
                <li class="nav-header">Reportes</li>
                <li class="nav-item">
                    <a href="<?php echo $menu_activo == 'verventas' ? '#' : base_url('dashboard/verventas'); ?>" class="nav-link <?php echo $menu_activo == 'verventas' ? 'active' : ''; ?>">
                        <i class="nav-icon bi bi-bar-chart-line"></i>
                        <p>Ver Ventas</p>
                    </a>
                </li>
                <?php
                if ($is_admin) {
                ?>
                    <li class="nav-item">
                        <a href="<?php echo $menu_activo == 'reportediario' ? '#' : base_url('dashboard/reportediario'); ?>" class="nav-link <?php echo $menu_activo == 'reportediario' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-bar-chart-line"></i>
                            <p>Reporte Diario</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $menu_activo == 'verventasperiodo' ? '#' : base_url('dashboard/verventasperiodo'); ?>" class="nav-link <?php echo $menu_activo == 'verventasperiodo' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-bar-chart-line"></i>
                            <p>Ver Ventas P.</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $menu_activo == 'veringresos' ? '#' : base_url('dashboard/veringresos'); ?>" class="nav-link <?php echo $menu_activo == 'veringresos' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-bar-chart-line"></i>
                            <p>Ver Ingresos.</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $menu_activo == 'veringresos' ? '#' : base_url('dashboard/veringresos'); ?>" class="nav-link <?php echo $menu_activo == 'veringresos' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-bar-chart-line"></i>
                            <p>Ver Ingresos Granel</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $menu_activo == 'vistaventashoyhoras' ? '#' : base_url('dashboard/vistaventashoyhoras'); ?>" class="nav-link <?php echo $menu_activo == 'verusuarios' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-bar-chart-line"></i>
                            <p>Ventas Horas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $menu_activo == 'vistaventashoyhoras' ? '#' : base_url('dashboard/verventasdetalladas'); ?>" class="nav-link <?php echo $menu_activo == 'verusuarios' ? 'active' : ''; ?>">
                            <i class="nav-icon bi bi-bar-chart-line"></i>
                            <p>Ventas Detalladas</p>
                        </a>
                    </li>
                <?php
                }
                ?>
                <li class="nav-header">Tienda</li>

                <li class="nav-item">
                    <a href="<?php echo $menu_activo == 'tienda' ? '#' : base_url('dashboard/pos'); ?>" class="nav-link <?php echo $menu_activo == 'tienda' ? 'active' : ''; ?>"> <i class="nav-icon bi bi-cart"></i>
                        <p>Vender</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $menu_activo == 'tienda' ? '#' : base_url('dashboard/vergastos'); ?>" class="nav-link <?php echo $menu_activo == 'gastos' ? 'active' : ''; ?>"> <i class="nav-icon bi bi-bag-dash"></i>
                        <p>Gastos</p>
                    </a>
                </li>
                <?php
                if ($is_admin) {
                ?>
                    <li class="nav-header">Administrador</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-people"></i>
                            <p>
                                Usuarios
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $menu_activo == 'verusuarios' ? '#' : base_url('dashboard/verusuarios'); ?>" class="nav-link <?php echo $menu_activo == 'verusuarios' ? 'active' : ''; ?>">
                                    <i class="nav-icon bi bi-people"></i>
                                    <p>Usuarios</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $menu_activo == 'nuevousuario' ? '#' : base_url('dashboard/nuevousuario'); ?>" class="nav-link <?php echo $menu_activo == 'nuevousuario' ? 'active' : ''; ?>">
                                    <i class="nav-icon bi bi-person-add"></i>
                                    <p>Nuevo Usuario</p>
                                </a>
                            </li>
                        </ul>

                    </li>
                <?php
                }
                ?>

            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar-->