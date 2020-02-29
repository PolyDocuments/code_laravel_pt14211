<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;

class HelloController extends Controller
{
    public function __invoke()
    {
        $posts = factory(Post::class, 10)->make();

        return view('hello_world', [
            'posts' => $posts,
        ]);
    }
}
