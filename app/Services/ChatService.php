<?php

namespace App\Services;

use App\Models\Message;
use App\Models\ChatbotRule;
use App\Services\KampusApiService;
use Carbon\Carbon;

class ChatService
{
    protected $kampusApi;

    public function __construct(KampusApiService $kampusApi)
    {
        $this->kampusApi = $kampusApi;
    }

    public function handle($clientId, $messageRaw)
    {
        $now = Carbon::now('Asia/Jakarta');

        $last = Message::where('client_id', $clientId)
            ->latest()
            ->first();

        if ($last && $last->status === 'admin') {

            Message::create([
                'client_id' => $clientId,
                'message' => $messageRaw,
                'is_admin' => false,
                'status' => 'admin'
            ]);

            return null;
        }

        // simpan pesan user
        Message::create([
            'client_id' => $clientId,
            'message' => $messageRaw,
            'is_admin' => false,
            'status' => 'bot'
        ]);

        if ($now->hour < 8 || $now->hour >= 15) {

            return $this->saveBotReply(
                $clientId,
                'Jam operasional telah usai. Pesan tetap kami terima dan akan dibalas admin 🙏',
                'admin'
            );
        }

        $message = $this->normalize($messageRaw);

        if ($reply = $this->handleNim($message)) {
            return $this->saveBotReply($clientId, $reply);
        }

        if ($reply = $this->handleNama($message)) {
            return $this->saveBotReply($clientId, $reply);
        }

        if ($reply = $this->handleRule($message)) {
            return $this->saveBotReply($clientId, $reply);
        }

        return $this->saveBotReply(
            $clientId,
            'Pesan kamu diteruskan ke admin 🙏',
            'admin'
        );
    }

    private function saveBotReply($clientId, $reply, $status = 'bot')
    {
        Message::create([
            'client_id' => $clientId,
            'message' => $reply,
            'is_admin' => true, // 🔥 ini kunci
            'status' => $status
        ]);

        return $reply;
    }

    private function normalize($text)
    {
        $text = strtolower(trim($text));
        return preg_replace('/[^a-z0-9 ]/', '', $text);
    }

    private function handleNim($message)
    {
        if (preg_match('/^[0-9]{6,15}$/', $message)) {
            $mhs = $this->kampusApi->getMahasiswaByNim($message);

            if ($mhs) {
                return "Nama : {$mhs['name']}\nNIM : {$mhs['nim']}";
            }
        }
        return null;
    }

    private function handleNama($message)
    {
        $result = $this->kampusApi->getAllMahasiswa(['name' => $message]);

        if ($result && isset($result['data']['data']) && count($result['data']['data']) > 0) {
            $mhs = $result['data']['data'][0];
            return "Nama : {$mhs['name']}\nNIM : {$mhs['nim']}";
        }

        return null;
    }

    private function handleRule($message)
    {
        $rules = ChatbotRule::select('keyword', 'reply')->get();

        foreach ($rules as $rule) {
            foreach (explode(',', strtolower($rule->keyword)) as $keyword) {

                $keyword = trim($keyword);

                if ($keyword && str_contains($message, $keyword)) {
                    return $rule->reply;
                }
            }
        }

        return null;
    }
}
