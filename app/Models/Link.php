<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['name', 'url'];

    public function getIconClassAttribute()
    {
        $url = strtolower($this->url);

        if (str_contains($url, 'instagram.com')) {
            return 'fa-brands fa-instagram';
        } elseif (str_contains($url, 'facebook.com')) {
            return 'fa-brands fa-facebook';
        } elseif (str_contains($url, 'youtube.com')) {
            return 'fa-brands fa-youtube';
        } elseif (str_contains($url, 'tiktok.com')) {
            return 'fa-brands fa-tiktok';
        } elseif (str_contains($url, 'linkedin.com')) {
            return 'fa-brands fa-linkedin';
        } elseif (str_contains($url, 'twitter.com') || str_contains($url, 'x.com')) {
            return 'fa-brands fa-x-twitter';
        } else {
            return 'fa-solid fa-globe';
        }
    }

    public function getHoverColorAttribute()
    {
        $url = strtolower($this->url);

        if (str_contains($url, 'facebook.com')) {
            return 'hover:bg-[#1877F2] hover:text-white hover:shadow-blue-500/40';
        } elseif (str_contains($url, 'instagram.com')) {
            return 'hover:bg-gradient-to-r hover:from-pink-500 hover:via-purple-500 hover:to-yellow-500 hover:text-white';
        } elseif (str_contains($url, 'youtube.com')) {
            return 'hover:bg-[#FF0000] hover:text-white hover:shadow-red-500/40';
        } elseif (str_contains($url, 'tiktok.com')) {
            return 'hover:bg-black hover:text-white hover:shadow-white/20';
        } elseif (str_contains($url, 'linkedin.com')) {
            return 'hover:bg-[#0A66C2] hover:text-white hover:shadow-blue-400/40';
        } elseif (str_contains($url, 'twitter.com') || str_contains($url, 'x.com')) {
            return 'hover:bg-black hover:text-white hover:shadow-gray-500/40';
        } else {
            return 'hover:bg-gray-700 hover:text-white';
        }
    }
}
