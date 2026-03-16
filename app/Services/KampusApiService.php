<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class KampusApiService
{

    protected $baseUrl = 'https://api';

    public function getMahasiswa($nim)
    {
        return Http::get($this->baseUrl."/mahasiswa/$nim")->json();
    }

    public function getNilai($nim)
    {
        return Http::get($this->baseUrl."/nilai/$nim")->json();
    }

}