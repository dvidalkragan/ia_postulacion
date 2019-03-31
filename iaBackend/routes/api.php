<?php

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

Route::post('login','ApiAuthController@login');
Route::post('logout','ApiAuthController@logout');


Route::group(['prefix' => 'v1'], function () {
    Route::group(['middleware'=> 'api', 'prefix' => 'users'], function() {
        Route::get('/','ApiUserController@me');
    });

    Route::group(['prefix' => 'landing/subscriptions'], function() {

        // MySQL Routes and Controllers
        //Route::get('/','CursoVeranoSQLController@list');
        //Route::post('/','CursoVeranoSQLController@new');
        //Route::delete('/{rut}','CursoVeranoSQLController@delete');

        // MongoDB Routes and Controllers
        Route::get('/','CursoVeranoNoSQLController@list');
        Route::post('/','CursoVeranoNoSQLController@new');
        Route::delete('/{rut}','CursoVeranoNoSQLController@delete');
    });
});

