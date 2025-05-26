<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use App\Models\Psych;
use Auth;

class ChatController extends Controller
{
    public function index($receiverType = null, $receiverId = null)
{
    $authUser = Auth::user();
    $authType = $authUser instanceof \App\Models\User ? 'user' : 'psych';
    $authId = $authUser->id;

    // Get list of all available users and psychs to chat with (excluding self if user)
    $users = \App\Models\User::where('id', '!=', $authType === 'user' ? $authId : 0)->get();
    $psychs = \App\Models\Psych::all();

    $chats = collect();

    if ($receiverType && $receiverId) {
        $chats = \App\Models\Chat::where(function ($q) use ($authId, $authType, $receiverId, $receiverType) {
            $q->where('sender_id', $authId)
              ->where('sender_type', $authType)
              ->where('receiver_id', $receiverId)
              ->where('receiver_type', $receiverType);
        })->orWhere(function ($q) use ($authId, $authType, $receiverId, $receiverType) {
            $q->where('sender_id', $receiverId)
              ->where('sender_type', $receiverType)
              ->where('receiver_id', $authId)
              ->where('receiver_type', $authType);
        })->orderBy('created_at')->get();
    }

    return view('chat.index', compact('users', 'psychs', 'chats', 'receiverType', 'receiverId'));
}


    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|integer',
            'receiver_type' => 'required|in:user,psych',
            'message' => 'required|string',
        ]);

        Chat::create([
            'sender_id' => Auth::id(),
            'sender_type' => Auth::user() instanceof \App\Models\User ? 'user' : 'psych',
            'receiver_id' => $request->receiver_id,
            'receiver_type' => $request->receiver_type,
            'message' => $request->message,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $chatId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $chat = Chat::findOrFail($chatId);

        // Optional: check if the authenticated user owns this message
        if ($chat->sender_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $chat->message = $request->input('message');
        $chat->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $chat = Chat::findOrFail($id);

        if ($chat->sender_id != Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $chat->delete();

        return redirect()->back();
    }

}
