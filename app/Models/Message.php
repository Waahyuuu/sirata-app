<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'chat_session_id',
        'client_id',
        'message',
        'sender_type',
        'is_read',
        'status',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function session()
    {
        return $this->belongsTo(ChatSession::class, 'chat_session_id');
    }

    public function getNimAttribute()
    {
        return $this->session?->nim;
    }

    public function getNamaMahasiswaAttribute()
    {
        return $this->session?->nama_mahasiswa;
    }

    public function getNamaIbuAttribute()
    {
        return $this->session?->nama_ibu;
    }

    public function getStatusSessionAttribute()
    {
        return $this->session?->status ?? 'guest';
    }

    public function scopeUser($query)
    {
        return $query->where('sender_type', 'user');
    }

    public function scopeBot($query)
    {
        return $query->where('sender_type', 'bot');
    }

    public function scopeAdmin($query)
    {
        return $query->where('sender_type', 'admin');
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}