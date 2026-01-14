<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('dashboard', function ($routes) {
    $routes->add('', 'Dashboard\Dashboard::index');
    $routes->add('productos', 'Dashboard\Dashboard::productos');
    $routes->add('nuevoproducto', 'Dashboard\Dashboard::nuevoproducto');
    $routes->add('editarproducto', 'Dashboard\Dashboard::editarproducto');
    $routes->add('editarproducto/(:num)', 'Dashboard\Dashboard::editarproducto/$1');
    $routes->add('eliminarproducto/(:num)', 'Dashboard\Dashboard::eliminarproducto/$1');
    $routes->add('pos', 'Dashboard\Dashboard::pos');
    $routes->add('ventaproducto/(:num)', 'Dashboard\Dashboard::ventaProducto/$1');
    $routes->add('verventas', 'Dashboard\Dashboard::verVentas');
    $routes->add('verventasdetalladas', 'Dashboard\Dashboard::verVentasDetalladas');
    $routes->add('verventasperiodo', 'Dashboard\Dashboard::verVentasperiodo');
    $routes->add('verinventario', 'Dashboard\Inventario::index');
    $routes->add('verinventario/(:alpha)', 'Dashboard\Inventario::index/$1');
    $routes->add('guardaringreso', 'Dashboard\Inventario::guardarIngreso');
    $routes->add('agregaringreso/(:num)', 'Dashboard\Inventario::formIngreso/$1');
    $routes->add('veringresos', 'Dashboard\Inventario::verIngresos');
    $routes->add('eliminarventa/(:num)', 'Dashboard\Dashboard::eliminarVenta/$1');
    $routes->add('eliminaringresounidad/(:num)', 'Dashboard\Inventario::eliminarIngresounidad/$1');


    // Inicio de manejo de gastos
    $routes->add('nuevogasto', 'Dashboard\Dashboard::nuevoGasto');
    $routes->add('vergastos', 'Dashboard\Gastos::verGastos');
    $routes->add('eliminargasto/(:num)', 'Dashboard\Gastos::eliminarGasto/$1');
    $routes->add('editargasto', 'Dashboard\Gastos::editarGasto');
    $routes->add('editargasto/(:num)', 'Dashboard\Gastos::editarGasto/$1');
    // Fin de manejo de gastos

    // Manejo de productos a granel
    $routes->add('verproductosgranel', 'Dashboard\Granel::verProductosGranel'); //si se usa
    $routes->add('nuevoproductogranel', 'Dashboard\Granel::nuevoproductogranel'); //si se usa
    $routes->add('editarproductogranel', 'Dashboard\Granel::editarProductoGranel');
    $routes->add('editarproductogranel/(:num)', 'Dashboard\Granel::editarProductoGranel/$1');
    $routes->add('eliminarproductogranel/(:num)', 'Dashboard\Granel::eliminarProductoGranel/$1');
    $routes->add('verinventariogranel', 'Dashboard\Granel::index');
    $routes->add('verinventariogranel/(:alpha)', 'Dashboard\Granel::index/$1');
    $routes->add('agregaringresogranel/(:num)', 'Dashboard\Granel::formIngresogranel/$1'); //si se usa
    $routes->add('guardaringresogranel', 'Dashboard\Granel::guardarIngresogranel');
    $routes->add('veringresosgranel', 'Dashboard\Inventario::verIngresosGranel');

    // fin de manejo de productos a granel

    $routes->add('guardarembolsadogranel', 'Dashboard\Granel::guardarEmbolsadoGranel');

    //proceso de embolsado
    $routes->add('agregarembolsadogranel', 'Dashboard\Embolsado::agregarEmbolsadoGranel');
    $routes->add('crear_composicion/(:num)', 'Dashboard\Embolsado::crearComposicion/$1');
    $routes->add('verembolsados', 'Dashboard\Embolsado::index');
    $routes->add('nuevo_embolsar/(:num)', 'Dashboard\Embolsado::nuevoEmbolsar/$1');
    $routes->add('obtener_composicion/(:num)', 'dashboard\Embolsado::obtenerComposicion/$1');
    // fin de proceso de embolsado

    // Inicio informes
    $routes->add('reportediario', 'Dashboard\Informes::reporteDiario');
    // Fin informes

    //
    $routes->add('vermasvendido', 'Dashboard\Dashboard::verMasVendido');
    // inicio de manejo de usuarios
    $routes->add('verusuarios', 'Dashboard\Usuarios::verUsuarios');
    $routes->add('nuevousuario', 'Dashboard\Usuarios::nuevoUsuario');
    $routes->add('editarusuario/(:num)', 'Dashboard\Usuarios::editarUsuario/$1');
    // fin de manejo de usuarios

    $routes->add('vistaventashoyhoras', 'Dashboard\Vistas::vistaVentasHoyHoras');

    $routes->add('informediario', 'Dashboard\Vistas::informeDiario');

    // Inicio conteo manual de inventario

    $routes->group('conteo-inventario', function ($routes) {
        $routes->get('/', 'Dashboard\ConteoInventario::index'); // Muestra el historial
        $routes->get('formularioConteo', 'Dashboard\ConteoInventario::formularioConteo'); // Muestra el formulario
        $routes->post('guardarConteoTemporal', 'Dashboard\ConteoInventario::guardarConteoTemporal');
        $routes->post('eliminarConteoTemporal', 'Dashboard\ConteoInventario::eliminarConteoTemporal');
        $routes->get('finalizarAjuste', 'Dashboard\ConteoInventario::finalizarAjuste');
        $routes->get('resultadoAjuste/(:num)', 'Dashboard\ConteoInventario::resultadoAjuste/$1');
        $routes->post('ajaxObtenerTabla', 'Dashboard\ConteoInventario::ajaxObtenerTabla');
    });
    // Fin conteo manual de inventario

    // **NUEVO: Grupo para transferencias**
    $routes->group('transferencias', function ($routes) {
        $routes->get('salida/(:num)', 'Dashboard\Transferencias::salida/$1');
        $routes->post('procesarSalida', 'Dashboard\Transferencias::procesarSalida');
    });

    // **NUEVO: Grupo para conteo de inventario a granel**
    $routes->group('conteo-inventario-granel', function ($routes) {
        $routes->get('/', 'Dashboard\ConteoInventarioGranel::index');
        $routes->get('formularioConteo', 'Dashboard\ConteoInventarioGranel::formularioConteo');
        $routes->post('guardarConteoTemporal', 'Dashboard\ConteoInventarioGranel::guardarConteoTemporal');
        $routes->post('eliminarConteoTemporal', 'Dashboard\ConteoInventarioGranel::eliminarConteoTemporal');
        $routes->get('finalizarAjuste', 'Dashboard\ConteoInventarioGranel::finalizarAjuste');
        $routes->get('resultadoAjuste/(:num)', 'Dashboard\ConteoInventarioGranel::resultadoAjuste/$1');
    });


    $routes->add('cerrarpos', 'Dashboard\Dashboard::cerrarPos');

    // $routes->add('shop', 'Dashboard\Dashboard::shop');
    // $routes->add('new_link', 'Dashboard\Dashboard::new_link');
    // $routes->add('erase_link/(:num)', 'Dashboard\Dashboard::erase_link/$1');
    // $routes->add('ver', 'Dashboard\Dashboard::ver');
});

service('auth')->routes($routes);
