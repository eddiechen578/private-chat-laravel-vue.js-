<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SessionResource extends Resource
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
            'open' => false,
            'users' => [$this->user1_id, $this->user2_id]
        ];
    }
}
