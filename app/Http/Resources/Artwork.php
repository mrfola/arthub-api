<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Artwork extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

        "title" => $this->title,
        "description" => $this->description,
        "number_of_comments" => $this->comments->count(),
        "number_of_up_votes" => $this->votes->where('vote', '1')->count(),
        "number_of_down_votes" => $this->votes->where('vote', '0')->count(),
        "user_name" => $this->user->name,
        "links" => [

            "artwork" =>  route('artwork.show', $this->id),
            "user_profile" => route('user.show', $this->user->id)

        ]

        ];
    }
}
