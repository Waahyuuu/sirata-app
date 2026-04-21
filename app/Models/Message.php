<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'client_id',
        'message',
        'is_admin',
        'is_read',
        'status'
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'is_read' => 'boolean',
    ];
    
    public function scopeUser($query)
    {
        return $query->where('is_admin', false);
    }

    public function scopeAdmin($query)
    {
        return $query->where('is_admin', true);
    }
}
