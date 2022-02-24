<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->title,
            'photo' => $this->photo,
            'bio' => $this->description,
            'lat' => $this->lat,
            'lon' => $this->lon,
            'isAnon' =>$this->isAnon,
            'interests' => InterestCollection::make($this->whenLoaded('interests')),
            'friends' => FriendCollection::make($this->whenLoaded('friends'))
        ];
    }
}
