<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
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
        "username" => $this->user->name,
        "description" => $this->comment,
        "links" => [
        "comment" => route('comment.show', $this->id),
        "artwork" => route('artwork.show',$this->artwork_id),
        "user" => route('user.show', $this->user->id)
        ]

        ];
    }
}
