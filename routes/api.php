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

Route::middleware('auth:api')->group(function () {
    // protected routes go here
    Route::group(['middleware' => ['json.response', 'cors']], function () {
        Route::post('users/valid','Auth\ApiAuthController@isValid');
        Route::resource('users', 'UserController');
    });

    
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register','Auth\ApiAuthController@register')->name('register.api');
});


