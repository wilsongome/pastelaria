<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use FastRoute\Route;

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

/* $router->get('/', function () use ($router) {
    return $router->app->version();
}); */


//CLIENTES
$router->get('/cliente', 'ClienteController@index');
$router->post('/cliente', 'ClienteController@create');
$router->get('/cliente/{id}', 'ClienteController@show');
$router->put('/cliente/{id}', 'ClienteController@update');
$router->delete('/cliente/{id}', 'ClienteController@delete');




