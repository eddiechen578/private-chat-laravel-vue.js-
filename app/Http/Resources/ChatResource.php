<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\Resource;

class ChatResource extends Resource
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
            'message' => $this->message['content'],
            'id' => $this->id,
            'type' => $this->type,
            'send_at' => $this->created_at->diffForHumans()
        ];
    }
}

