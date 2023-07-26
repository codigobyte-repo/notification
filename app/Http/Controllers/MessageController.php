<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
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

        Message::create($data);

        session()->flash('flash.banner', '¡Mensaje Enviado correctamente!');

        return redirect()->route('messages.create');
    }
}
