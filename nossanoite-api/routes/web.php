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
    return "API Nossa Noite LTDA. 2021...";
});

$router->group([
    
    'middleware' => 'authRoute',
    'prefix' => 'auth'

], function() use($router) {
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

$router->group(['prefix' => 'api/v1/users'], function() use($router) {
    $router->post('/auth/login', ['uses' => 'AuthController@login']);
    $router->get('/list', [
        'middleware' => 'authRoute',
        'uses' => 'UserController@getAllUsers'
        ]);
    $router->get('/searchbyid={id}', [
        'middleware' => 'authRoute',
        'uses' => 'UserController@getById'
        ]);
    $router->post('/post', [
        'middleware' => 'authRoute',
        'uses' => 'UserController@postUser'
        ]);
    $router->put('/updateid={id}', [
        'middleware' => 'authRoute',
        'uses' => 'UserController@updateUser'
        ]);
    $router->delete('/deletebyid={id}', [
        'middleware' => 'authRoute',
        'uses' => 'UserController@deleteUser'
        ]);
}); 

$router->group(['prefix' => 'api/v1/movies'], function() use($router) {
    $router->get('/list', ['uses' => 'MovieController@getList']);
    $router->get('/searchbytitle={title}', ['uses' => 'MovieController@searchMovieByTitle']);
    $router->get('/searchbyid={id}', ['uses' => 'MovieController@searchMovieById']);
    $router->post('/post', [
        'middleware' => 'authRoute',
        'uses' => 'MovieController@postMovie'
    ]);
    $router->put('/updatebyid={id}', [
        'middleware' => 'authRoute',
        'uses' => 'MovieController@updateMovieById'
    ]);
    $router->delete('/deletebyid={id}', [
        'middleware' => 'authRoute',
        'uses' => 'MovieController@deleteMovie'
    ]);

});

$router->group(['prefix' => 'api/v1/foods'], function() use($router) {
    $router->get('/list', ['uses' => 'FoodController@getList']);
    $router->get('/searchbyfood={name}', ['uses' => 'FoodController@searchFoodByTitle']);
    $router->post('/post', [
        'middleware' => 'authRoute',
        'uses' => 'FoodController@postFood'
    ]);
    $router->put('/updatebyid={id}', [
        'middleware' => 'authRoute',
        'uses' => 'FoodController@updateFoodById'
    ]);
    $router->delete('/deletebyid={id}', [
        'middleware' => 'authRoute',
        'uses' => 'FoodController@deleteFood'
    ]);

});

$router->group(['prefix' => 'api/v1/candys'], function() use($router) {
    $router->get('/list', ['uses' => 'CandyController@getList']);
    $router->get('/searchbycandy={name}', ['uses' => 'CandyController@searchCandyByTitle']);
    $router->get('/searchcandybyid={id}', ['uses' => 'CandyController@searchCandyById']);
    $router->post('/post', [
        'middleware' => 'authRoute',
        'uses' => 'CandyController@postCandy'
    ]);
    $router->put('/updatebyid={id}', [
        'middleware' => 'authRoute',
        'uses' => 'CandyController@updateCandyById'
    ]);
    $router->delete('/deletebyid={id}', [
        'middleware' => 'authRoute',
        'uses' => 'CandyController@deleteCandy'
    ]);
});

$router->group(['prefix' => 'api/v1/drinks'], function() use($router) {
    $router->get('/list', ['uses' => 'DrinkController@getList']);
    $router->get('/searchbydrink={name}', ['uses' => 'DrinkController@searchDrinkByTitle']);
    $router->get('/searchdrinkbyid={id}', ['uses' => 'DrinkController@searchDrinkById']);
    $router->post('/post', [
        'middleware' => 'authRoute',
        'uses' => 'DrinkController@postDrink'
    ]);
    $router->put('/updatebyid={id}', [
        'middleware' => 'authRoute',
        'uses' => 'DrinkController@updateDrinkById'
    ]);
    $router->delete('/deletebyid={id}', [
        'middleware' => 'authRoute',
        'uses' => 'DrinkController@deleteDrink'
    ]);
});

$router->group(['prefix' => 'api/v1/extras'], function() use($router) {
    $router->get('/list', ['uses' => 'ExtraController@getList']);
    $router->get('/searchbyextra={name}', ['uses' => 'ExtraController@searchExtraByTitle']);
    $router->get('/searchextrabyid={id}', ['uses' => 'ExtraController@searchExtraById']);
    $router->post('/post', [
        'middleware' => 'authRoute',
        'uses' => 'ExtraController@postExtra'
    ]);
    $router->put('/updatebyid={id}', [
        'middleware' => 'authRoute',
        'uses' => 'ExtraController@updateExtraById'
    ]);
    $router->delete('/deletebyid={id}', [
        'middleware' => 'authRoute',
        'uses' => 'ExtraController@deleteExtra'
    ]);
});

