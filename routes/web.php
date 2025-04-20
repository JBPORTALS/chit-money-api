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

$router->group(['prefix' => 'api'], function () use ($router) {

  //Collector Group
  $router->group(['prefix' => 'collectors', "middleware" => "clerk.auth"], function () use ($router) {

    //Profile Routes
    $router->get('/profile', 'CollectorController@get');
    $router->post('/profile', 'CollectorController@create');
    $router->put('/profile', 'CollectorController@update');
    $router->delete('/profile', 'CollectorController@delete');

    //Contact Routes
    $router->get('/contact', 'ContactController@getForCollector');
    $router->put('/contact', 'ContactController@updateForCollector');

    //Bank Details Routes

    //Organization Routes

    //Batch Routes
  });
});
