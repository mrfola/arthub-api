<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArtworkResource extends JsonResource
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
        "id" => $this->id,
        "name" => $this->name,
        "description" => $this->description,
        "uploads" => $this->uploads,
        "user" => $this->user->name,
        "comments" => $this->comments,
        "links" => [
        "comments" => route('comment.index', $this->id),
        "user" => route('user.show', $this->user->id),
        "artwork_collection" => route('artwork.index', $this->user->id)
        ]
        ];
    }
}
