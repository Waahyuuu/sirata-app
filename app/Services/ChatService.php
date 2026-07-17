<?php

namespace App\Services;

use App\Models\Message;
use App\Models\ChatSession;
use App\Models\Faq;
use App\Models\Manfaat;
use App\Services\KampusApiService;
use Carbon\Carbon;

class ChatService
{
    protected $kampusApi;

    public function __construct(KampusApiService $kampusApi)
    {
        $this->kampusApi = $kampusApi;
    }

    public function getWelcomeMessage($clientId)
    {
        return "👋 Selamat datang di SIRATA CHATBOT!\n\n" .
            "Saya adalah asisten virtual SIRATA (Sistem Rapor STIMATA)\n" .
            "yang siap membantu Anda.\n\n" .
            "📋 Layanan yang tersedia:\n\n" .
            "1. 🎓 INFORMASI NIM - Cari data mahasiswa\n" .
            "   (Cukup dengan nama lengkap)\n\n" .
            "2. 👨‍💼 BERBICARA DENGAN ADMIN\n" .
            "   (Jam operasional 07.00-15.00 WIB)\n\n" .
            "3. ✨ MANFAAT - Info tentang SIRATA\n\n" .
            "💡 Tips: Ketik salah satu menu di atas untuk memulai.\n" .
            "Contoh: ketik 'informasi nim' untuk mencari NIM.\n\n" .
            "Ada yang bisa saya bantu? 😊";
    }

    public function handle($clientId, $messageRaw)
    {
        $now = Carbon::now('Asia/Jakarta');

        $last = Message::where('client_id', $clientId)
            ->latest()
            ->first();

        $chatSession = ChatSession::where('client_id', $clientId)->first();

        $messageLower = strtolower(trim($messageRaw));

        // =============================================
        // TERIMA KASIH
        // =============================================
        $terimaKasih = ['terima kasih', 'makasih', 'thanks', 'thank you', 'thx', 'trims', 'matur nuwun'];
        foreach ($terimaKasih as $ucapan) {
            if (str_contains($messageLower, $ucapan)) {
                return $this->saveBotReply(
                    $clientId,
                    "Sama-sama! 😊\n\n" .
                        "Senang bisa membantu Anda.\n\n" .
                        "Ada yang lain bisa saya bantu? " .
                        "Silakan ketik 'menu' untuk melihat layanan yang tersedia.",
                    $chatSession
                );
            }
        }

        // =============================================
        // SALAM
        // =============================================
        $salam = ['halo', 'hai', 'hey', 'hello', 'hi', 'assalamualaikum', 'selamat pagi', 'selamat siang', 'selamat sore', 'selamat malam'];
        foreach ($salam as $ucapan) {
            if (str_contains($messageLower, $ucapan)) {
                $waktu = $this->getWaktu();
                return $this->saveBotReply(
                    $clientId,
                    "{$waktu}! 👋\n\n" .
                        "Ada yang bisa saya bantu?\n\n" .
                        "💡 Ketik 'menu' untuk melihat layanan yang tersedia.",
                    $chatSession
                );
            }
        }

        // =============================================
        // PAK/BU
        // =============================================
        if (str_contains($messageLower, 'pak') || str_contains($messageLower, 'bu')) {
            return $this->saveBotReply(
                $clientId,
                "Ada yang bisa saya bantu, Bapak/Ibu? 😊\n\n" .
                    "💡 Ketik 'menu' untuk melihat layanan yang tersedia.",
                $chatSession
            );
        }

        // =============================================
        // CEK APAKAH USER SEDANG CHAT DENGAN ADMIN
        // =============================================
        if ($last && $last->sender_type === 'admin') {
            $messageData = [
                'client_id' => $clientId,
                'message' => $messageRaw,
                'sender_type' => 'user',
                'is_read' => false,
                'status' => 'sent'
            ];
            
            if ($chatSession) {
                $messageData['chat_session_id'] = $chatSession->id;
            }
            
            Message::create($messageData);
            return null;
        }

        // =============================================
        // SIMPAN PESAN USER
        // =============================================
        $messageData = [
            'client_id' => $clientId,
            'message' => $messageRaw,
            'sender_type' => 'user',
            'is_read' => false,
            'status' => 'sent'
        ];
        
        if ($chatSession) {
            $messageData['chat_session_id'] = $chatSession->id;
        }
        
        Message::create($messageData);

        $message = $this->normalize($messageRaw);

        // =============================================
        // MENU
        // =============================================
        if (
            str_contains($message, 'menu') ||
            str_contains($message, 'help') ||
            str_contains($message, 'bantuan') ||
            str_contains($message, 'tolong')
        ) {
            return $this->saveBotReply(
                $clientId,
                "📋 MENU UTAMA SIRATA\n\n" .
                    "• informasi nim - Cari data mahasiswa\n" .
                    "• berbicara dengan admin - Chat admin\n" .
                    "• manfaat - Info SIRATA\n" .
                    "• Pertanyaan Terkait SIRATA\n\n" .
                    "💡 Ketik salah satu menu di atas untuk memulai.",
                $chatSession
            );
        }

        // =============================================
        // INFORMASI NIM
        // =============================================
        if (cache()->get('chatbot_waiting_name_' . $clientId)) {
            if (in_array($message, ['no', 'tidak', 'batal'])) {
                cache()->forget('chatbot_waiting_name_' . $clientId);
                return $this->saveBotReply(
                    $clientId,
                    "✅ Pencarian mahasiswa dibatalkan.\n\n" .
                        "Silakan pilih menu lain atau ketik 'menu' untuk melihat layanan.",
                    $chatSession
                );
            }

            $reply = $this->handleNama($message, $clientId);

            if ($reply && str_contains($reply, '🎓 DATA MAHASISWA')) {
                cache()->forget('chatbot_waiting_name_' . $clientId);
            }

            return $this->saveBotReply(
                $clientId,
                $reply ??
                    "❌ Data mahasiswa tidak ditemukan.\n\n" .
                    "Silakan ketik nama lengkap mahasiswa.\n\n" .
                    "💡 Ketik 'batal' untuk membatalkan.",
                $chatSession
            );
        }

        if (
            str_contains($message, 'nim') ||
            str_contains($message, 'nomor induk') ||
            str_contains($message, 'informasi nim') ||
            str_contains($message, 'cari nim') ||
            str_contains($message, 'cek nim')
        ) {
            cache()->put(
                'chatbot_waiting_name_' . $clientId,
                true,
                now()->addMinutes(10)
            );

            return $this->saveBotReply(
                $clientId,
                "🎓 INFORMASI NIM\n\n" .
                    "Silakan masukkan nama lengkap mahasiswa.\n\n" .
                    "Contoh: Andi Saputra\n\n" .
                    "💡 Ketik 'batal' untuk membatalkan.",
                $chatSession
            );
        }

        // =============================================
        // CHAT DENGAN ADMIN
        // =============================================
        if (
            str_contains($message, 'admin') ||
            str_contains($message, 'berbicara dengan admin') ||
            str_contains($message, 'bicara admin') ||
            str_contains($message, 'hubungi admin')
        ) {
            if ($now->hour < 7 || $now->hour >= 15) {
                return $this->saveBotReply(
                    $clientId,
                    "🙏 Maaf, layanan Admin SIRATA sedang tidak beroperasi.\n\n"
                        . "🕐 Jam operasional:\n"
                        . "Senin - Jumat\n"
                        . "Pukul 07.00 - 15.00 WIB.\n\n"
                        . "Silakan hubungi kembali pada jam operasional.\n\n"
                        . "Sementara itu Anda tetap dapat menggunakan:\n"
                        . "• informasi nim - Cari NIM\n"
                        . "• manfaat - Info SIRATA\n\n" .
                        "Ada yang bisa saya bantu? 😊",
                    $chatSession
                );
            }

            return $this->saveBotReply(
                $clientId,
                "👨‍💼 Baik.\n\n" .
                    "Anda akan terhubung dengan Admin SIRATA.\n" .
                    "Silakan tuliskan pertanyaan Anda.\n" .
                    "Admin akan membalas segera.\n\n" .
                    "💡 Sambil menunggu, Anda bisa:\n" .
                    "• Mencari informasi NIM\n" .
                    "• Melihat manfaat SIRATA",
                $chatSession,
                'admin'
            );
        }

        // =============================================
        // MANFAAT
        // =============================================
        if (
            str_contains($message, 'manfaat') ||
            str_contains($message, 'tujuan') ||
            str_contains($message, 'fungsi') ||
            str_contains($message, 'keuntungan')
        ) {
            return $this->saveBotReply(
                $clientId,
                $this->getManfaat(),
                $chatSession
            );
        }

        // =============================================
        // FAQ
        // =============================================
        if ($reply = $this->findFaq($message)) {
            return $this->saveBotReply(
                $clientId,
                $reply . "\n\n" .
                    "💡 Ada yang lain bisa saya bantu?",
                $chatSession
            );
        }

        // =============================================
        // DEFAULT REPLY
        // =============================================
        return $this->saveBotReply(
            $clientId,
            "Maaf, saya belum memahami pertanyaan tersebut. 🤔\n\n" .
                "📋 Silakan pilih salah satu layanan berikut:\n\n" .
                "• informasi nim - Cari NIM\n" .
                "• berbicara dengan admin - Chat admin\n" .
                "• manfaat - Info SIRATA\n" .
                "• menu - Lihat semua layanan\n\n" .
                "💡 Ketik 'menu' untuk melihat semua layanan.",
            $chatSession
        );
    }

    // =============================================
    // GET WAKTU
    // =============================================
    private function getWaktu()
    {
        $hour = Carbon::now('Asia/Jakarta')->hour;

        if ($hour >= 5 && $hour < 11) {
            return "Selamat pagi 🌅";
        } elseif ($hour >= 11 && $hour < 15) {
            return "Selamat siang ☀️";
        } elseif ($hour >= 15 && $hour < 18) {
            return "Selamat sore 🌤️";
        } else {
            return "Selamat malam 🌙";
        }
    }

    // =============================================
    // SAVE BOT REPLY - DIPERBAIKI!
    // =============================================
    private function saveBotReply($clientId, $reply, $chatSession = null, $senderType = 'bot')
    {
        $data = [
            'client_id' => $clientId,
            'message' => $reply,
            'sender_type' => $senderType,  // ✅ 'bot' atau 'admin'
            'is_read' => false,
            'status' => 'sent'
        ];
        
        if ($chatSession) {
            $data['chat_session_id'] = $chatSession->id;
            // ✅ HANYA chat_session_id, TIDAK ADA nim, nama_mahasiswa, nama_ortu
        }
        
        Message::create($data);
        return $reply;
    }

    // =============================================
    // NORMALISASI
    // =============================================
    private function normalize($text)
    {
        $text = strtolower(trim($text));
        return preg_replace('/[^a-z0-9 ]/', '', $text);
    }

    // =============================================
    // FAQ
    // =============================================
    private function findFaq($message)
    {
        $faqs = Faq::all();

        foreach ($faqs as $faq) {
            $question = $this->normalize($faq->question);

            if (
                str_contains($message, $question) ||
                str_contains($question, $message)
            ) {
                return $faq->answer;
            }
        }

        return null;
    }

    // =============================================
    // MANFAAT
    // =============================================
    private function getManfaat()
    {
        $manfaat = Manfaat::all();

        if ($manfaat->isEmpty()) {
            return "✨ MANFAAT SIRATA\n\n" .
                "SIRATA membantu Anda:\n" .
                "• Mendapat informasi akademik\n" .
                "• Terhubung dengan admin\n" .
                "• Dan masih banyak lagi!";
        }

        $reply = "✨ MANFAAT SIRATA\n\n";

        foreach ($manfaat as $item) {
            $reply .= "📌 {$item->title}\n";
            $reply .= "   {$item->description}\n\n";
        }

        return trim($reply);
    }

    // =============================================
    // CARI NIM MAHASISWA
    // =============================================
    private function handleNama($message, $clientId = null)
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

        $exact = $mahasiswas->first(function ($item) use ($message) {
            return strtolower(trim($item['name'] ?? '')) === strtolower(trim($message));
        });

        if ($exact) {
            $ortu = '-';

            if (!empty($exact['stimata_email'])) {
                $detail = $this->kampusApi
                    ->getMahasiswaByEmail($exact['stimata_email']);

                $ortu = data_get(
                    $detail,
                    'prospective.mother_name',
                    '-'
                );
            }

            return "🎓 DATA MAHASISWA\n\n" .
                "Nama: {$exact['name']}\n" .
                "NIM: {$exact['nim']}\n" .
                "Nama Ibu: {$ortu}\n";
        }

        $reply = "🔍 Nama yang mirip ditemukan:\n\n";

        foreach ($mahasiswas->take(5) as $i => $mhs) {
            $reply .= ($i + 1) . ". {$mhs['name']}\n";
        }

        $reply .= "\nSilakan ketik kembali nama lengkap mahasiswa.";
        $reply .= "\n💡 Ketik 'batal' untuk membatalkan.";

        return $reply;
    }
}