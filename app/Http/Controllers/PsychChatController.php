<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Psych;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PsychChatController extends Controller
{
    public function __construct()
    {
        // Only allow authenticated users with 'psych' guard
        $this->middleware('auth:psych');
    }

    public function index(Request $request)
    {
        $receiverType = $request->query('receiverType');
        $receiverId = $request->query('receiverId');

        if (Auth::guard('user')->check()) {
            $authUser = Auth::guard('user')->user();
            $authType = 'user';
            $authId = $authUser->id;

            $psychs = Psych::all();
            $users = User::where('id', '!=', $authId)->get();
        } elseif (Auth::guard('psych')->check()) {
            $authUser = Auth::guard('psych')->user();
            $authType = 'psych';
            $authId = $authUser->id;

            $users = User::all();
            $psychs = Psych::where('id', '!=', $authId)->get();
        } else {
            abort(403, 'Unauthorized access.');
        }

        $chats = collect();

        if ($receiverType && $receiverId) {
            $chats = Chat::where(function ($q) use ($authId, $authType, $receiverId, $receiverType) {
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

        return view('psychchat.index', compact('psychs', 'users', 'chats', 'receiverType', 'receiverId'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|integer',
            'receiver_type' => 'required|in:psych,user',
            'message' => 'required|string|max:1000',
        ]);

        $senderId = null;
        $senderType = null;

        if (Auth::guard('user')->check()) {
            $senderId = Auth::guard('user')->id();
            $senderType = 'user';
        } elseif (Auth::guard('psych')->check()) {
            $senderId = Auth::guard('psych')->id();
            $senderType = 'psych';
        } else {
            abort(403, 'Unauthorized action.');
        }

        Chat::create([
            'sender_id' => $senderId,
            'sender_type' => $senderType,
            'receiver_id' => $request->receiver_id,
            'receiver_type' => $request->receiver_type,
            'message' => $request->message,
        ]);

        return redirect()->back();
    }

    public function destroy(Request $request, $chatId)
    {
        $chat = Chat::findOrFail($chatId);

        if (Auth::guard('user')->check()) {
            $authId = Auth::guard('user')->id();
            $authType = 'user';
        } elseif (Auth::guard('psych')->check()) {
            $authId = Auth::guard('psych')->id();
            $authType = 'psych';
        } else {
            abort(403, 'Unauthorized action.');
        }

        if ($chat->sender_id !== $authId || $chat->sender_type !== $authType) {
            abort(403, 'Unauthorized action.');
        }

        $chat->delete();

        // Check if AJAX request, respond with JSON, else redirect back
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        } else {
            return redirect()->back();
        }
    }
}
