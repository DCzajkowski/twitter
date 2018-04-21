<?php

namespace App\Http\Controllers;

use App\Follow;
use App\User;
use Auth;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function store()
    {
        $followed = User::where('name', $username = request('username'))->first();

        if (! $followed) {
            abort(400, 'No user with username: ' . $username);
        }

        $follow = new Follow;
        $follow->follower_id = Auth::id();
        $follow->followed_id = $followed->id;
        $follow->save();

        return redirect()->back();
    }

    public function destroy()
    {
        $followed = User::where('name', $username = request('username'))->first();

        if (! $followed) {
            abort(400, 'No user with username: ' . $username);
        }

        $follow = Follow::where('follower_id', Auth::id())->where('followed_id', $followed->id)->first();

        if (! $follow) {
            return redirect()->back();
        }

        $follow->delete();

        return redirect()->back();
    }
}
