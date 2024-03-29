<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $guarded=[];

    public function chats()
    {
        return $this->hasManyThrough(Chat::class, Message::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
