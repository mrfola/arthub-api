<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Artwork;
use App\User;

class Vote extends Model
{
	protected $guarded = [];
    public function artwork()
    {
        return $this->belongsTo(Artwork::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
