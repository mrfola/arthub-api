<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoteResource extends JsonResource
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
            'id' => $this->id,
            'user_name' => $this->user->name,
            'vote' => $this->vote,
            'links' => [
            'artwork' => route('artwork.show', $this->artwork_id),
            'user' => route('user.show', $this->user_id)
            ]
        ];
    }
}
