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

Route::get('/', function () {
    return view('welcome');
});

Route::get('hello_world', function () {
    // Handle request
    $posts = factory(Post::class, 10)->make();

    return view('hello_world', [
        'posts' => $posts,
    ]);
})->name('home.hello_world');

Route::group([
    'prefix' => 'users',
    'as' => 'users.',
], function () {
    Route::get('create', function () {
        $user = factory(User::class, 1)->make()->first();

        // Facade
        // Route::redirect('users.show');

        // Helper
        return redirect()->route('users.show')->with([
            'user' => $user,
        ]);
    })->name('create');

    Route::get('show', function () {
        dd(session()->get('user'));
    })->name('show');
});

Route::group([
    'prefix' => 'post',
    'as' => 'post.',
], function () {
    Route::get('create', function () {
        dd("Hello");
    })->name('create');
    Route::get('show', function () {
        dd("Show Post!");
    })->name('show');
});
