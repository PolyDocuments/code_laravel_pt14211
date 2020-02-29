<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\User;
use App\Models\Post;

Route::view('/', 'welcome');

Route::group([
    'middleware' => [
        'check_auth',
    ],
], function () {
    Route::get('hello_world', 'HelloController')->name('home.hello_world');

    Route::resource('users', 'UserController')->middleware([
        'check_role_admin',
    ]);
});

Route::get('login', 'AuthController@getLoginForm');
Route::post('login', 'AuthController@login')->name('auth.login');
