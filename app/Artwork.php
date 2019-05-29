<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\Upload;
use App\Vote;
use App\User;

class Artwork extends Model
{
    protected $guarded = [];
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
