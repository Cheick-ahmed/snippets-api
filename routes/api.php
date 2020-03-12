<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

    Route::get('me', 'MeController');

    Route::post('login', 'LoginController');

    Route::post('logout', 'LogoutController');

    Route::post('register', 'RegisterController');
});

Route::group(['prefix' => 'me', 'namespace' => 'Me'], function () {

    Route::get('snippets', 'SnippetController@index');

});

Route::group(['prefix' => 'users/{user}', 'namespace' => 'Users'], function () {
    Route::get('', 'UserController@show');
    Route::patch('', 'UserController@update');
    Route::get('snippets', 'SnippetController@index');
});

Route::group(['prefix' => 'snippets', 'namespace' => 'Snippet'], function () {

    /**
     * Snippet
     */

    Route::get('', 'SnippetController@index');

    Route::post('', 'SnippetController@store');

    Route::get('{snippet}', 'SnippetController@show');

    Route::patch('{snippet}', 'SnippetController@update');

    Route::delete('{snippet}', 'SnippetController@destroy');

    /**
     * Step
     */

    Route::post('{snippet}/steps', 'StepController@store');

    Route::patch('{snippet}/steps/{step}', 'StepController@update');

    Route::delete('{snippet}/steps/{step}', 'StepController@destroy');

});
