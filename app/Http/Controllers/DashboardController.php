<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manfaat;
use App\Models\Link;
use App\Models\Faq;
use App\Models\ChatbotRule;
use App\Services\KampusApiService;

class DashboardController extends Controller
{
    public function index(Request $request, KampusApiService $api)
    {
        $totalMahasiswa = cache()->remember('total_mahasiswa', 3600, function () use ($api) {

            try {
                $total = 0;
                $cursor = null;

                do {
                    $params = ['size' => 1000];
                    if ($cursor) $params['cursor'] = $cursor;

                    $result = $api->getAllMahasiswa($params);
                    $batch  = $result['data'] ?? [];

                    $total += count($batch);

                    $cursor = $result['meta']['next'] ?? null;
                } while ($cursor && count($batch) > 0);

                return $total;
            } catch (\Exception $e) {
                return 0;
            }
        });

        return view('admin.dashboard.index', [
            'stats' => [
                ['label' => 'Mahasiswa', 'value' => $totalMahasiswa],
                ['label' => 'Manfaat', 'value' => Manfaat::count()],
                ['label' => 'Link', 'value' => Link::count()],
                ['label' => 'FAQ', 'value' => Faq::count()],
                ['label' => 'Chatbot', 'value' => ChatbotRule::count()],
            ]
        ]);
    }
}
