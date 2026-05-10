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
                'message'   => $messageRaw,
                'is_admin'  => false,
                'status'    => 'admin'
            ]);

            return null;
        }

        Message::create([
            'client_id' => $clientId,
            'message'   => $messageRaw,
            'is_admin'  => false,
            'status'    => 'bot'
        ]);

        if ($now->hour < 8 || $now->hour >= 15) {

            return $this->saveBotReply(
                $clientId,
                'Jam operasional telah usai. Pesan tetap kami terima dan akan dibalas admin 🙏',
                'admin'
            );
        }

        $message = $this->normalize($messageRaw);

        if (cache()->get('chatbot_waiting_name_' . $clientId)) {

            if (
                in_array($message, [
                    'no',
                    'tidak',
                    'batal'
                ])
            ) {

                cache()->forget(
                    'chatbot_waiting_name_' . $clientId
                );

                return $this->saveBotReply(
                    $clientId,
                    "✅ Pencarian mahasiswa telah diakhiri.\n\n"
                        . "Silakan kirim pesan lain jika membutuhkan bantuan."
                );
            }

            $reply = $this->handleNama($message);

            if (
                $reply &&
                str_contains($reply, 'DATA MAHASISWA')
            ) {

                cache()->forget(
                    'chatbot_waiting_name_' . $clientId
                );
            }

            if ($reply) {

                return $this->saveBotReply(
                    $clientId,
                    $reply
                );
            }

            return $this->saveBotReply(
                $clientId,
                "❌ Data mahasiswa tidak ditemukan.\n\n"
                    . "Silakan coba ketik nama lengkap mahasiswa.\n"
                    . "Atau ketik No untuk mengakhiri pencarian."
            );
        }

        if (
            str_contains($message, 'nim') ||
            str_contains($message, 'nomor induk')
        ) {

            cache()->put(
                'chatbot_waiting_name_' . $clientId,
                true,
                now()->addMinutes(10)
            );

            return $this->saveBotReply(
                $clientId,
                "🎓 Pencarian NIM Mahasiswa\n\n"
                    . "Silakan masukkan nama lengkap mahasiswa."
            );
        }

        if ($reply = $this->handleRule($message)) {

            return $this->saveBotReply(
                $clientId,
                $reply
            );
        }

        return $this->saveBotReply(
            $clientId,
            'Pesan kamu diteruskan ke admin 🙏',
            'admin'
        );
    }

    private function saveBotReply(
        $clientId,
        $reply,
        $status = 'bot'
    ) {

        Message::create([
            'client_id' => $clientId,
            'message'   => $reply,
            'is_admin'  => true,
            'status'    => $status
        ]);

        return $reply;
    }

    private function normalize($text)
    {
        $text = strtolower(trim($text));

        return preg_replace(
            '/[^a-z0-9 ]/',
            '',
            $text
        );
    }

    private function handleRule($message)
    {
        $rules = ChatbotRule::select(
            'keyword',
            'reply'
        )->get();

        foreach ($rules as $rule) {

            foreach (
                explode(',', strtolower($rule->keyword))
                as $keyword
            ) {

                $keyword = trim($keyword);

                if (
                    $keyword &&
                    str_contains($message, $keyword)
                ) {

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
            'size'   => 10,
            'page'   => 1
        ]);

        if (
            !$result ||
            !isset($result['data']) ||
            count($result['data']) < 1
        ) {

            return null;
        }

        $mahasiswas = collect($result['data']);

        $exact = $mahasiswas->first(function ($item)
        use ($message) {

            $namaDb = strtolower(
                trim($item['name'] ?? '')
            );

            $input = strtolower(
                trim($message)
            );

            return $namaDb === $input;
        });

        if ($exact) {

            $email = $exact['stimata_email'] ?? null;

            $nama = $exact['name'] ?? '-';
            $nim  = $exact['nim'] ?? '-';

            $ortu = '-';

            if ($email) {

                $detail = $this->kampusApi
                    ->getMahasiswaByEmail($email);

                $ortu = data_get(
                    $detail,
                    'prospective.mother_name',
                    '-'
                );
            }

            return "Data mahasiswa dari {$nama}\n\n"
                . "NIM : {$nim}\n"
                . "Nama Ibu : {$ortu}\n\n"
                . "Silakan sesuaikan data ini dengan kebutuhan Anda.";
        }

        $list = $mahasiswas->take(5);

        $reply = "🔍 Nama yang mirip ditemukan:\n\n";

        foreach ($list as $index => $mhs) {

            $no = $index + 1;

            $reply .= "{$no}. {$mhs['name']}\n";
        }

        $reply .= "\nSilakan ketik kembali nama lengkap mahasiswa.";
        $reply .= "\nAtau ketik No untuk mengakhiri pencarian.";

        return $reply;
    }
}
