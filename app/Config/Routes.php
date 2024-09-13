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
    $routes->add('pos', 'Dashboard\Dashboard::pos');
    $routes->add('ventaproducto', 'Dashboard\Dashboard::ventaProducto');
    $routes->add('verventas', 'Dashboard\Dashboard::verVentas');
    $routes->add('verinventario', 'Dashboard\Dashboard::ver_inventario');
    // $routes->add('shop', 'Dashboard\Dashboard::shop');
    // $routes->add('new_link', 'Dashboard\Dashboard::new_link');
    // $routes->add('erase_link/(:num)', 'Dashboard\Dashboard::erase_link/$1');
    // $routes->add('ver', 'Dashboard\Dashboard::ver');
});

service('auth')->routes($routes);
