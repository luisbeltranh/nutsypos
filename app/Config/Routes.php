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
    $routes->add('pos', 'Dashboard\Dashboard::pos');
    $routes->add('ventaproducto', 'Dashboard\Dashboard::ventaProducto');
    $routes->add('verventas', 'Dashboard\Dashboard::verVentas');
    $routes->add('verinventario', 'Dashboard\Inventario::index');
    $routes->add('guardaringreso', 'Dashboard\Inventario::guardarIngreso');
    $routes->add('agregaringreso/(:num)', 'Dashboard\Inventario::formIngreso/$1');
    $routes->add('vergranel', 'Dashboard\Granel::index');
    $routes->add('agregaringresogranel/(:num)', 'Dashboard\Granel::formIngresogranel/$1');
    $routes->add('granelembolsado/(:num)', 'Dashboard\Granel::formGranelEmbolsado/$1');
    $routes->add('verusuarios', 'Dashboard\Usuarios::verUsuarios');
    $routes->add('nuevousuario', 'Dashboard\Usuarios::nuevoUsuario');

    // $routes->add('shop', 'Dashboard\Dashboard::shop');
    // $routes->add('new_link', 'Dashboard\Dashboard::new_link');
    // $routes->add('erase_link/(:num)', 'Dashboard\Dashboard::erase_link/$1');
    // $routes->add('ver', 'Dashboard\Dashboard::ver');
});

service('auth')->routes($routes);
