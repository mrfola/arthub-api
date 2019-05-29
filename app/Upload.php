<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Artwork;

class Upload extends Model
{
	protected $guarded = [];
     public function artwork()
    {
        return $this->belongsTo(Artwork::class);
    }
}
