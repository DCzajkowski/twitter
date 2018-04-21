<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $follows = Follow::where('follower_id', Auth::id())->get()->map(function ($follow) {
            return $follow->followed_id;
        })->push(Auth::id())->toArray();

        $tweets = Tweet::whereIn('user_id', $follows)->with('user')->latest()->get();

        return view('home', compact('tweets'));
    }
}
