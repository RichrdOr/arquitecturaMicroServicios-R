<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// --- Rutas del Microservicio de Reviews ---
$router->get('/reviews', 'ReviewController@index');
$router->post('/reviews', 'ReviewController@store');
$router->get('/reviews/{review}', 'ReviewController@show');
$router->put('/reviews/{review}', 'ReviewController@update');
$router->patch('/reviews/{review}', 'ReviewController@update');
$router->delete('/reviews/{review}', 'ReviewController@destroy');