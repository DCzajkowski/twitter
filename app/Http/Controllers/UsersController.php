<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function show($username)
    {
        $user = User::where('name', $username)->first();

        if ($user === null) {
            abort(404, 'No user with that handle');
        }

        return view('users.show', compact('user'));
    }
}
