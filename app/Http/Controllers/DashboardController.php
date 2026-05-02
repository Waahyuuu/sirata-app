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
        /**
         * =====================================================
         * AMBIL TOTAL MAHASISWA DARI API
         * =====================================================
         */
        $totalMahasiswa = 0;
        try {
            $allData = [];
            $cursor = null;

            do {
                $params = ['size' => 1000];
                if ($cursor) $params['cursor'] = $cursor;

                $result = $api->getAllMahasiswa($params);
                $batch = $result['data'] ?? [];
                $allData = array_merge($allData, $batch);

                $cursor = $result['meta']['next'] ?? null;
            } while ($cursor && count($batch) > 0);

            $totalMahasiswa = count($allData);
        } catch (\Exception $e) {
            $totalMahasiswa = 0;
        }

        /**
         * =====================================================
         * AMBIL TOTAL DARI DATABASE LOKAL
         * =====================================================
         */
        $totalManfaat  = Manfaat::count();
        $totalLink     = Link::count();
        $totalFaq      = Faq::count();
        $totalChatbot  = ChatbotRule::count();

        return view('admin.dashboard', compact(
            'totalMahasiswa',
            'totalManfaat',
            'totalLink',
            'totalFaq',
            'totalChatbot'
        ));
    }
}
