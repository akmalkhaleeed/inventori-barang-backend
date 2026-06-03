<?php

/** @var \Laravel\Lumen\Routing\Router $router */

// Jalur tes biasa
$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Tulis manual dan polos tanpa group prefix
$router->post('api/login', 'AuthController@login');
$router->post('/api/login', 'AuthController@login'); // Kita pasang dua-duanya biar kalau salah satu gak kebaca, yang satunya lolos!