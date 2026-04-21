<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\ChatbotRule;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        $chats = Message::select(
            'client_id',
            DB::raw('MAX(id) as last_id'),
            DB::raw('SUM(CASE WHEN is_admin = 0 AND is_read = 0 THEN 1 ELSE 0 END) as unread')
        )
            ->groupBy('client_id')
            ->orderByDesc('last_id')
            ->get();

        $lastMessages = Message::whereIn('id', $chats->pluck('last_id'))
            ->get()
            ->keyBy('id');

        $chats = $chats->map(function ($chat) use ($lastMessages) {
            $chat->last = $lastMessages[$chat->last_id] ?? null;
            return $chat;
        });

        $rules = ChatbotRule::latest()->get();

        return view('admin.pesan.index', compact('chats', 'rules'));
    }

    public function show(Request $request)
    {
        $clientId = $request->client_id;
        $lastId = (int) ($request->last_id ?? 0);

        if (!$clientId) return response()->json([]);

        Message::where('client_id', $clientId)
            ->where('is_admin', false)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::where('client_id', $clientId)
            ->where('id', '>', $lastId)
            ->orderBy('id')
            ->limit(50)
            ->get();

        return response()->json(
            $messages->map(fn($msg) => [
                'id' => $msg->id,
                'text' => $msg->message,
                'from' => $msg->is_admin ? 'admin' : 'user',
                'time' => $msg->created_at->format('H:i')
            ])
        );
    }

    public function reply(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'message' => 'required'
        ]);

        $msg = Message::create([
            'client_id' => $request->client_id,
            'message' => $request->message,
            'is_admin' => true,
            'is_read' => true,
            'status' => 'admin'
        ]);

        return response()->json([
            'id' => $msg->id,
            'text' => $msg->message,
            'from' => 'admin',
            'time' => $msg->created_at->format('H:i')
        ]);
    }

    public function list()
    {
        $chats = Message::select(
            'client_id',
            DB::raw('MAX(id) as last_id'),
            DB::raw('SUM(CASE WHEN is_admin = 0 AND is_read = 0 THEN 1 ELSE 0 END) as unread')
        )
            ->groupBy('client_id')
            ->orderByDesc('last_id')
            ->get();

        $lastMessages = Message::whereIn('id', $chats->pluck('last_id'))
            ->get()
            ->keyBy('id');

        return response()->json(
            $chats->map(function ($chat) use ($lastMessages) {
                return [
                    'client_id' => $chat->client_id,
                    'unread' => $chat->unread,
                    'last' => optional($lastMessages[$chat->last_id])->message
                ];
            })
        );
    }

    public function deleteAllMessage()
    {
        Message::query()->delete();

        return redirect()->back()->with('success', 'Semua pesan berhasil dihapus');
    }
}
