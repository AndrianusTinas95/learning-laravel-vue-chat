<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(){
        return auth()
                ->user()
                ->messages()
                ->where(function($q){
                    $q->bySender(request()->input('sender_id'))     ->byReceiver(auth()->user()->id);
                })
                ->orWhere(function($q){
                    $q->bySender(auth()->user()->id)
                      ->byReceiver(request()->input('sender_id'));
                })
                ->get();
    }

    public function store(Request $request){
        $message = Message::create([
            'sender_id' => $request->input('sender_id'),
            'receiver_id' => $request->input('receiver_id'),
            'message' => $request->input('message'),
        ]);

        broadcast(new MessageSent($message));

        return $message->fresh();
    }
}
