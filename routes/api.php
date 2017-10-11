<?php

use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'middleware' => ['api']], function (Router $router) {
    $router->get('/balance', 'ApiController@balanceAction');
    $router->post('/deposit', 'ApiController@depositAction');
    $router->post('/withdraw', 'ApiController@withdrawAction');
    $router->post('/transfer', 'ApiController@transferAction');
});
