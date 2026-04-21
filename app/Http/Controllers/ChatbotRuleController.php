<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotRule;
use App\Services\ChatService;

class ChatbotRuleController extends Controller
{
    public function chat(Request $request, ChatService $chatService)
    {
        $request->validate([
            'message' => 'required|string',
            'client_id' => 'required|string'
        ]);

        $reply = $chatService->handle(
            $request->client_id,
            $request->message
        );

        return response()->json([
            'reply' => $reply,
            'time' => now()->format('H:i'),
            'hasReply' => $reply !== null
        ]);
    }

    public function index()
    {
        $rules = ChatbotRule::latest()->get();
        return view('admin.pesan', compact('rules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keyword' => 'required',
            'reply' => 'required'
        ]);

        ChatbotRule::create($request->only('keyword', 'reply'));

        return back()->with('success', 'Rule berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $rule = ChatbotRule::findOrFail($id);
        $rule->update($request->only('keyword', 'reply'));

        return back()->with('success', 'Rule berhasil diupdate');
    }

    public function destroy($id)
    {
        ChatbotRule::findOrFail($id)->delete();

        return back()->with('success', 'Rule berhasil dihapus');
    }

    public function deleteAll()
    {
        ChatbotRule::truncate();

        return back()->with('success', 'Semua rule dihapus');
    }
}
