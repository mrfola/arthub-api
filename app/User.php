<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Artwork;
use App\Comment;
use App\Upload;
use App\Vote;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function artworks()
    {
        return $this->hasMany(Artwork::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
