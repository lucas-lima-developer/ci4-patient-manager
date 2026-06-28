<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Pacientes::index');

$routes->resource('pacientes', [
    'controller'  => 'Pacientes',
    'placeholder' => '(:num)',
    'websafe'     => true,
]);
