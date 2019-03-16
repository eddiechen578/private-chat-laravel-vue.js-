<?php

namespace App\Http\Controllers;

use App\Events\PrivateChatEvent;
use App\Http\Resources\ChatResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;
use App\Entities\Session;
class ChatController extends Controller
{
    public function send(Session $session, Request $request)
    {
        $message =  $session->messages()->create(['content' => $request->content]);

        $chat = $message->createForSend($session->id);

        $message->createForReceive($session->id, $request->to_user);

        broadcast(new PrivateChatEvent($message->content, $chat));

        return response($message, 200);
    }

    public function chats(Session $session){

        $chats = $session->chats;
        $selectChats = $chats->where('user_id', auth()->id())->values();
        return  ChatResource::collection($selectChats);
    }
}
