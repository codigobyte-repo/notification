<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Notifications\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class MessageController extends Controller
{
    public function show(Message $message)
    {
        return $message;
    }

    public function create()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required',
            'body' => 'required',
            'recipient_id' => 'required|exists:users,id',
        ]);

        $data['sender_id'] = auth()->user()->id;

        $message = Message::create($data);

        /* Envío de correo */
        $recipient = User::find($data['recipient_id']);
        $recipient->notify(new MessageSent($message));


        session()->flash('flash.banner', '¡Mensaje Enviado correctamente!');

        return redirect()->route('messages.create');
    }
}
