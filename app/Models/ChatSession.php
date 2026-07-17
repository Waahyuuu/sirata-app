<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    protected $fillable = [
        'client_id',
        'nim',
        'nama_mahasiswa',
        'nama_ibu',
        'email',
        'status',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_session_id');
    }
}