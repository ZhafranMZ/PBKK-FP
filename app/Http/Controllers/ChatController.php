<?php

namespace App\Http\Controllers;

use App\Events\ChatMade;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function chat()
    {
        return Inertia::render('Home');
    }
    public function send(Request $request){
        $request->validate([ 
            'comment' => 'required',
        ]);
        $user = auth()->user()->id;
        dispatch(new ChatMade($request->message, $user));
    }
    // public function send(){
    //     // $request->validate([ 
    //     //     'comment' => 'required',
    //     // ]);
    //     $message='tessss';
    //     $user = auth()->user()->id;
    //     event(new ChatMade($message, $user));
    // }
    public function saveToSession(request $request)
    {
    	session()->put('chat',$request->chat);
    }

    public function getOldMessage()
    {
    	return session('chat');
    }

    public function deleteSession()
    {
    	session()->forget('chat');
    }
}
