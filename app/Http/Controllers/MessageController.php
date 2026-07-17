<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\ChatSession;
use App\Services\ChatService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    protected $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    /*
    |--------------------------------------------------------------------------
    | Dummy Data Mahasiswa Cekal
    |--------------------------------------------------------------------------
    */
    private function mahasiswaCekal()
    {
        return [
            [
                'nim' => '231100001',
                'nama' => 'Andi Saputra',
                'prodi' => 'Sistem Informasi',
                'status' => 'Dicekal',
                'orang_tua' => 'Bapak Ahmad',
                'telepon' => '082132789255'
            ],
            [
                'nim' => '23520014',
                'nama' => 'Annas Magfuri AlMaulidi',
                'prodi' => 'Teknik Informatika',
                'status' => 'Dicekal',
                'orang_tua' => 'Ibu Siti',
                'telepon' => '08970316116'
            ],
            [
                'nim' => '231100003',
                'nama' => 'Citra Dewi',
                'prodi' => 'Manajemen Informatika',
                'status' => 'Dicekal',
                'orang_tua' => 'Bapak Joko',
                'telepon' => '082112223333'
            ]
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX - HALAMAN ADMIN PESAN
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $chats = Message::select(
            'client_id',
            DB::raw('MAX(id) as last_id'),
            DB::raw('SUM(CASE WHEN sender_type = "user" AND is_read = 0 THEN 1 ELSE 0 END) as unread')
        )
            ->with(['session'])
            ->groupBy('client_id')
            ->orderByDesc('last_id')
            ->get();

        $lastMessages = Message::whereIn('id', $chats->pluck('last_id'))
            ->get()
            ->keyBy('id');

        $chats = $chats->map(function ($chat) use ($lastMessages) {
            $chat->last = $lastMessages[$chat->last_id] ?? null;

            if ($chat->session) {
                $chat->nim = $chat->session->nim;
                $chat->nama_mahasiswa = $chat->session->nama_mahasiswa;
                $chat->nama_ibu = $chat->session->nama_ibu;
                $chat->status = $chat->session->status;
                $chat->email = $chat->session->email;
            } else {
                $chat->nim = null;
                $chat->nama_mahasiswa = null;
                $chat->nama_ibu = null;
                $chat->status = 'guest';
                $chat->email = null;
            }

            return $chat;
        });

        $mahasiswaCekal = $this->mahasiswaCekal();

        return view(
            'admin.pesan.index',
            compact('chats', 'mahasiswaCekal')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW - ADMIN MELIHAT PESAN PER CLIENT
    |--------------------------------------------------------------------------
    */
    public function show(Request $request)
    {
        $clientId = $request->client_id;
        $lastId = (int) ($request->last_id ?? 0);

        if (!$clientId) {
            return response()->json([]);
        }

        Message::where('client_id', $clientId)
            ->where('sender_type', 'user')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $session = ChatSession::where('client_id', $clientId)->first();
        $sessionData = null;
        if ($session) {
            $sessionData = [
                'nim' => $session->nim,
                'nama_mahasiswa' => $session->nama_mahasiswa,
                'nama_ibu' => $session->nama_ibu,
                'status' => $session->status,
            ];
        }

        $messages = Message::where('client_id', $clientId)
            ->where('id', '>', $lastId)
            ->orderBy('id', 'asc')
            ->limit(50)
            ->get();

        return response()->json([
            'messages' => $messages->map(function ($msg) {
                $from = 'user';
                if ($msg->sender_type === 'admin') {
                    $from = 'admin';
                } elseif ($msg->sender_type === 'bot') {
                    $from = 'admin';
                }

                return [
                    'id' => $msg->id,
                    'text' => $msg->message,
                    'from' => $from,
                    'time' => $msg->created_at->format('H:i')
                ];
            }),
            'session' => $sessionData
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | GET USER MESSAGES - USER CHATBOX
    |--------------------------------------------------------------------------
    */
    public function getUserMessages(Request $request)
    {
        $clientId = $request->query('client_id');
        $lastId = (int) $request->query('last_id', 0);

        if (!$clientId) {
            return response()->json([]);
        }

        Message::where('client_id', $clientId)
            ->whereIn('sender_type', ['admin', 'bot'])
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::where('client_id', $clientId)
            ->where('id', '>', $lastId)
            ->orderBy('id', 'asc')
            ->limit(50)
            ->get();

        return response()->json(
            $messages->map(function ($msg) {
                $from = ($msg->sender_type === 'user') ? 'user' : 'admin';
                return [
                    'id' => $msg->id,
                    'text' => $msg->message,
                    'from' => $from,
                    'time' => $msg->created_at->format('H:i')
                ];
            })
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SEND WELCOME MESSAGE
    |--------------------------------------------------------------------------
    */
    public function sendWelcome(Request $request)
    {
        $request->validate([
            'client_id' => 'required|string'
        ]);

        $clientId = $request->client_id;

        $welcomeMessage = $this->chatService->getWelcomeMessage($clientId);

        $chatSession = ChatSession::where('client_id', $clientId)->first();

        $messageData = [
            'client_id' => $clientId,
            'message' => $welcomeMessage,
            'sender_type' => 'bot',
            'is_read' => false,
            'status' => 'sent'
        ];

        if ($chatSession) {
            $messageData['chat_session_id'] = $chatSession->id;
        }

        $botMessage = Message::create($messageData);

        return response()->json([
            'bot_reply' => [
                'id' => $botMessage->id,
                'text' => $botMessage->message,
                'time' => $botMessage->created_at->format('H:i')
            ]
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE USER MESSAGE - USER KIRIM PESAN
    |--------------------------------------------------------------------------
    */
    public function storeUserMessage(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required|string',
                'client_id' => 'required|string'
            ]);

            $clientId = $request->client_id;

            $chatSession = ChatSession::where('client_id', $clientId)->first();

            $messageData = [
                'client_id' => $clientId,
                'message' => $request->message,
                'sender_type' => 'user',
                'is_read' => false,
                'status' => 'sent'
            ];

            if ($chatSession) {
                $messageData['chat_session_id'] = $chatSession->id;
            }

            $message = Message::create($messageData);

            try {
                $reply = $this->chatService->handle($clientId, $request->message);
            } catch (\Exception $e) {
                Log::error('ChatService error: ' . $e->getMessage());
                $reply = "Maaf, terjadi kesalahan. Silakan coba lagi nanti.";
            }

            $botMessage = Message::where('client_id', $clientId)
                ->where('sender_type', 'bot')
                ->latest()
                ->first();

            return response()->json([
                'id' => $message->id,
                'text' => $message->message,
                'from' => 'user',
                'time' => $message->created_at->format('H:i'),
                'bot_reply' => $botMessage ? [
                    'id' => $botMessage->id,
                    'text' => $botMessage->message,
                    'time' => $botMessage->created_at->format('H:i')
                ] : null
            ]);
        } catch (\Exception $e) {
            Log::error('Store message error: ' . $e->getMessage());

            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN REPLY - ADMIN BALAS PESAN
    |--------------------------------------------------------------------------
    */
    public function reply(Request $request)
    {
        try {
            $request->validate([
                'client_id' => 'required',
                'message' => 'required'
            ]);

            $clientId = $request->client_id;

            $chatSession = ChatSession::where('client_id', $clientId)->first();

            $messageData = [
                'client_id' => $clientId,
                'message' => $request->message,
                'sender_type' => 'admin',
                'is_read' => true,
                'status' => 'read'
            ];

            if ($chatSession) {
                $messageData['chat_session_id'] = $chatSession->id;
            }

            $msg = Message::create($messageData);

            Message::where('client_id', $clientId)
                ->where('sender_type', 'user')
                ->latest()
                ->update(['status' => 'read']);

            return response()->json([
                'id' => $msg->id,
                'text' => $msg->message,
                'from' => 'admin',
                'time' => $msg->created_at->format('H:i')
            ]);
        } catch (\Exception $e) {
            Log::error('Reply error: ' . $e->getMessage());

            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | LIST CHAT - UNTUK ADMIN (DIPERBAIKI)
    |--------------------------------------------------------------------------
    */
    public function list()
    {
        // =============================================
        // PERBAIKAN: Group by chat_session_id jika ada
        // =============================================
        $chats = Message::select(
            'client_id',
            'chat_session_id',
            DB::raw('MAX(id) as last_id'),
            DB::raw('SUM(CASE WHEN sender_type = "user" AND is_read = 0 THEN 1 ELSE 0 END) as unread')
        )
            ->with(['session'])
            ->groupBy('client_id', 'chat_session_id')
            ->orderByDesc('last_id')
            ->get();

        $lastMessages = Message::whereIn('id', $chats->pluck('last_id'))
            ->get()
            ->keyBy('id');

        return response()->json(
            $chats->map(function ($chat) use ($lastMessages) {
                $lastMsg = $lastMessages[$chat->last_id] ?? null;

                $session = $chat->session;

                if ($session) {
                    $nim = $session->nim;
                    $namaMahasiswa = $session->nama_mahasiswa;
                    $namaIbu = $session->nama_ibu;
                    $status = $session->status;
                } else {
                    $nim = null;
                    $namaMahasiswa = null;
                    $namaIbu = null;
                    $status = 'guest';
                }

                $label = $chat->client_id;
                if ($status === 'parent' && $namaMahasiswa && $nim) {
                    $label = "ortu-{$namaMahasiswa}-{$nim}";
                } elseif ($nim && $namaMahasiswa) {
                    $label = "{$namaMahasiswa} ({$nim})";
                }

                $cleanText = $lastMsg ? $lastMsg->message : '-';
                $cleanText = preg_replace('/\s+/', ' ', trim($cleanText));
                $cleanText = substr($cleanText, 0, 80) . (strlen($cleanText) > 80 ? '...' : '');

                return [
                    'client_id' => $chat->client_id,
                    'chat_session_id' => $chat->chat_session_id,
                    'label' => $label,
                    'last_id' => $chat->last_id,
                    'unread' => $chat->unread,
                    'last' => $lastMsg ? $lastMsg->message : null,
                    'preview' => $cleanText,
                    'is_new' => $chat->unread > 0,
                    'nim' => $nim,
                    'nama_mahasiswa' => $namaMahasiswa,
                    'nama_ibu' => $namaIbu,
                    'status' => $status,
                ];
            })
        );
    }

    /*
    |--------------------------------------------------------------------------
    | WHATSAPP ORANG TUA
    |--------------------------------------------------------------------------
    */
    public function kirimWA($nim)
    {
        $mahasiswa = collect($this->mahasiswaCekal())
            ->firstWhere('nim', $nim);

        if (!$mahasiswa) {
            return back()->with('error', 'Mahasiswa tidak ditemukan.');
        }

        $nohp = preg_replace('/[^0-9]/', '', $mahasiswa['telepon']);

        if (substr($nohp, 0, 1) == '0') {
            $nohp = '62' . substr($nohp, 1);
        }

        $pesan = urlencode(
            "Yth. Orang tua/Wali dari {$mahasiswa['nama']},\n\n" .
                "Perkenalkan, kami dari *Admin SIRATA (Sistem Rapor STIMATA)* STMIK PPKIA Pradnya Paramitha Malang.\n\n" .
                "Melalui pesan ini kami ingin menyampaikan informasi mengenai status akademik mahasiswa:\n\n" .
                "Nama : {$mahasiswa['nama']}\n" .
                "NIM  : {$mahasiswa['nim']}\n\n" .
                "Berdasarkan data akademik kampus, mahasiswa tersebut saat ini berstatus *DICEKAL*.\n\n" .
                "Kami mohon bantuan Bapak/Ibu selaku orang tua/wali untuk mengingatkan mahasiswa agar segera menghubungi Bagian Akademik STIMATA guna memperoleh informasi lebih lanjut dan menyelesaikan kendala akademik yang sedang dihadapi.\n\n" .
                "Apabila mahasiswa telah melakukan penyelesaian administrasi atau status akademiknya telah diperbarui, mohon abaikan pesan ini.\n\n" .
                "Atas perhatian dan kerja sama Bapak/Ibu, kami ucapkan terima kasih.\n\n" .
                "Hormat kami,\n" .
                "*Admin SIRATA*\n\n" .
                "*_Peringatan:_*\n" .
                "_Pesan ini hanya bersifat pemberitahuan._\n" .
                "_STIMATA tidak pernah meminta password, PIN, kode OTP, ataupun transfer sejumlah uang melalui WhatsApp maupun SMS._\n\n" .
                "_Apabila menerima permintaan tersebut atas nama STIMATA, mohon jangan ditanggapi dan segera hubungi Bagian Akademik STIMATA._\n\n"
        );

        return redirect("https://wa.me/{$nohp}?text={$pesan}");
    }

    /*
    |--------------------------------------------------------------------------
    | DUMMY SMS
    |--------------------------------------------------------------------------
    */
    public function kirimSMS($nim)
    {
        $mahasiswa = collect($this->mahasiswaCekal())
            ->firstWhere('nim', $nim);

        if (!$mahasiswa) {
            return back()->with('error', 'Mahasiswa tidak ditemukan.');
        }

        return back()->with(
            'success',
            "SMS pemberitahuan kepada {$mahasiswa['orang_tua']} berhasil dikirim."
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE ALL MESSAGES
    |--------------------------------------------------------------------------
    */
    public function deleteAllMessage()
    {
        Message::query()->delete();

        return redirect()
            ->back()
            ->with('success', 'Semua pesan berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | MARK AS READ - ADMIN TANDAI PESAN SUDAH DIBACA
    |--------------------------------------------------------------------------
    */
    public function markAsRead(Request $request)
    {
        try {
            $request->validate([
                'client_id' => 'required|string'
            ]);

            $clientId = $request->client_id;

            $updated = Message::where('client_id', $clientId)
                ->where('sender_type', 'user')
                ->where('is_read', false)
                ->update(['is_read' => true]);

            return response()->json([
                'success' => true,
                'updated' => $updated,
                'message' => 'Pesan telah ditandai sebagai dibaca'
            ]);
        } catch (\Exception $e) {
            Log::error('Mark as read error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | UNREAD COUNT - JUMLAH PESAN BELUM DIBACA
    |--------------------------------------------------------------------------
    */
    public function unreadCount()
    {
        try {
            $count = Message::where('sender_type', 'user')
                ->where('is_read', false)
                ->count();

            return response()->json([
                'unread' => $count,
                'success' => true
            ]);
        } catch (\Exception $e) {
            Log::error('Unread count error: ' . $e->getMessage());
            return response()->json([
                'unread' => 0,
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
