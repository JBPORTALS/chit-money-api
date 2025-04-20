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

$router->group(['prefix' => 'api', "middleware" => "clerk.auth"], function () use ($router) {

  //Collector Group
  $router->group(['prefix' => 'collectors'], function () use ($router) {

    #Profile Routes
    $router->get('/profile', 'CollectorController@get');
    $router->post('/profile', 'CollectorController@create');
    $router->put('/profile', 'CollectorController@update');
    $router->delete('/profile', 'CollectorController@delete');

    #Contact Routes
    $router->get('/contact', 'ContactController@getForCollector');
    $router->put('/contact', 'ContactController@updateForCollector');

    #Bank Details Routes
    $router->get('/bank-details', 'BankDetailController@getForCollector');
    $router->put('/bank-details', 'BankDetailController@updateForCollector');

    #Organization Routes
    $router->get('/organization', 'OrganizationController@get');
    $router->put('/organization', 'OrganizationController@updateOrCreate');

    #Batch Routes
    $router->get('/organization/{orgId}/batches', 'BatchController@list');
    $router->post('/organization/{orgId}/batches', 'BatchController@create');
    $router->get('/batches/{batchId}', 'BatchController@getById');
    $router->put('/batches/{batchId}', 'BatchController@update');
    $router->delete('/batches/{batchId}', 'BatchController@delete');

    #Batch Subscribers

    #Payments

    #Payouts

    #Credit Score

    #Analytics
  });

  //Collector Group
  $router->group(['prefix' => 'collectors'], function () use ($router) {

    #Profile Routes

    #Contact Routes

    #Bank Details Routes

    #Batch Routes

    #Batch Subscribers

    #Payments

    #Payouts

    #Credit Score

    #Analytics
  });
});
