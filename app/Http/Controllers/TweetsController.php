<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetsController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'body' => 'min:3,max:120,required',
        ]);

        $tweet = new Tweet;
        $tweet->user_id = Auth::id();
        $tweet->body = $data['body'];
        $tweet->save();

        return redirect()->back();
    }
}
