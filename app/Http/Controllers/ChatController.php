<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::all();
        return view('chat.index', compact('chats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'gift_type' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Chat::create($data);
        return back()->with('success', 'Mesajınız başarıyla gönderildi!');
    }
}
