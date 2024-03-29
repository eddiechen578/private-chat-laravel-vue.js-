<?php

namespace App\Http\Controllers;

use App\Events\SessionEvent;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Entities\Session;
use App\Http\Resources\SessionResource;

class SessionController extends Controller
{
   public function create(Request $request)
   {
       $session = Session::create([
          'user1_id' => auth()->id(),
          'user2_id' => $request->friend_id,
       ]);
       $modifiedSession = new SessionResource($session);
       broadcast(new SessionEvent($modifiedSession, auth()->id()));
       return $modifiedSession;
   }
}
