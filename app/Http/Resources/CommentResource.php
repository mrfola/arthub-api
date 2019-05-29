<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
        "username" => $this->user->name,
        "description" => $this->comment,
        "created_at" => $this->created_at,
        "updated_at" => $this->updated_at,
        "links" => [
        "user" => route('user.show', $this->user_id),
        "artwork" => route('artwork.show', $this->artwork_id),
        "comment_collection" => route('comment.index', $this->artwork_id)
        ]
        ];
    }
}
