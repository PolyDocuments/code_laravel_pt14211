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
    Route::post('store', function () {
        $request = request()->all();
        $data = array_except($request, ['_token']);

        $user = User::create($data);

        return redirect()->route('users.index');
    })->name('store');

    Route::get('create', function () {
        return view('users.create');
    })->name('create');

    Route::get('show/{user}', function (User $user) {
        return view('users.show', [
            'userData' => $user,
        ]);
    })->name('show');

    Route::get('/', function () {
        $users = User::all();

        return view('users.index', [
            'users' => $users,
        ]);
    })->name('index');

    Route::post('delete', function () {
        $request = request()->all();
        $user = User::find($request['id']);

        $user->delete();

        return redirect()->route('users.index');
    })->name('delete');
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
