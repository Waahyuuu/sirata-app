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

        if ($reply = $this->handleNama($message)) {
            return $this->saveBotReply($clientId, $reply);
        }

        if ($reply = $this->handleRule($message)) {
            return $this->saveBotReply($clientId, $reply);
        }

        if ($now->hour < 8 || $now->hour >= 15) {

            return $this->saveBotReply(
                $clientId,
                'Jam operasional telah usai. Pesan tetap kami terima dan akan dibalas admin 🙏',
                'admin'
            );
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
            'is_admin' => true,
            'status' => $status
        ]);

        return $reply;
    }

    private function normalize($text)
    {
        $text = strtolower(trim($text));
        return preg_replace('/[^a-z0-9 ]/', '', $text);
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

    private function handleNama($message)
    {
        $result = $this->kampusApi->getAllMahasiswa([
            'search' => $message,
            'size' => 10,
            'page' => 1
        ]);

        if (
            !$result ||
            !isset($result['data']['data']) ||
            count($result['data']['data']) < 1
        ) {
            return null;
        }

        $mahasiswa = collect($result['data']['data'])->first(function ($item) use ($message) {

            return str_contains(
                strtolower($item['name'] ?? ''),
                strtolower($message)
            );
        });

        if (!$mahasiswa) {
            return null;
        }

        $email = $mahasiswa['stimata_email'] ?? null;

        if (!$email) {

            return "Data Mahasiswa Ditemukan\n\n"
                . "Nama : {$mahasiswa['name']}\n"
                . "NIM : {$mahasiswa['nim']}";
        }

        $detail = $this->kampusApi->getMahasiswaByEmail($email);

        $nama = $mahasiswa['name'] ?? '-';
        $nim  = $mahasiswa['nim'] ?? '-';

        $ortu = data_get(
            $detail,
            'prospective.mother_name',
            '-'
        );

        return "Data Mahasiswa Ditemukan\n\n"
            . "Nama : {$nama}\n"
            . "NIM : {$nim}\n"
            . "Nama Orang Tua : {$ortu}";
    }
}
