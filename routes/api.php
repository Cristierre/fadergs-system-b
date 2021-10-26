<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an API application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
    // login
    $api->post('auth/login', 'AuthController@login');
    // refresh jwt token
    $api->post('auth/login/refresh', 'AuthController@refreshToken');
    // need authentication
    $api->group(['middleware' => 'api.auth'], function ($api) {
        //User
        $api->get('user','UserControlle@index');
        //Rooms
        $api->get('rooms','RoomsController@index');
        $api->get('rooms/busy','RoomsController@listBusyRooms');
        $api->get('rooms/free','RoomsController@listFreeRooms');
        $api->get('rooms/{id}','RoomsController@show');

    });
});
