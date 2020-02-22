<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('posts')->get();

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store()
    {
        $request = request()->all();
        $data = array_except($request, ['_token']);

        $user = User::create($data);

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('users.show', [
            'userData' => $user,
        ]);
    }

    public function delete()
    {
        $request = request()->all();
        $user = User::find($request['id']);

        $user->delete();

        return redirect()->route('users.index');
    }
}
