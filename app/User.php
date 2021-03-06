<?php

namespace App;

use App\Follow;
use App\Tweet;
use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function follows($user)
    {
        return ! is_null(Follow::where('follower_id', Auth::id())->where('followed_id', $user->id)->first());
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class)->latest();
    }


    public function getAvatarAttribute()
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email);
    }
}
