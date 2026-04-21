<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotRule extends Model
{
    protected $fillable = [
        'keyword',
        'reply'
    ];
    
    public function setKeywordAttribute($value)
    {
        $this->attributes['keyword'] = strtolower($value);
    }
}
