<?php

namespace App\Http\Controllers;

use App\Tweet;
use App\User;
use Illuminate\Http\Request;

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
