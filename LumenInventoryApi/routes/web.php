<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/inventory', 'InventoryController@index');
$router->post('/inventory', 'InventoryController@store');
$router->get('/inventory/book/{book_id}', 'InventoryController@showByBook');
$router->put('/inventory/{id}', 'InventoryController@update'); // Nueva
$router->post('/inventory/reserve', 'InventoryController@reserve'); // Nueva
$router->post('/inventory/release', 'InventoryController@release');
