<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', 'CabasaController@home');


//Api routes to authenticate users using passport authentication system
Route::post('cabasa/login', 'UserController@login');
Route::post('cabasa/register', 'UserController@register');


// To output list all items in the database
Route::get('cabasas', 'CabasaController@index');

// To show a single data
Route::get('cabasa/{id}', 'CabasaController@show');

// To create to populate the database with new data
Route::post('cabasa', 'CabasaController@store');

// To update a data
Route::put('cabasa/{id}', 'CabasaController@update');

// To Delete a data
Route::delete('cabasa/{id}', 'CabasaController@destroy');
