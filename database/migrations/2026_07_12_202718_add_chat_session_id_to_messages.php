<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('messages', 'chat_session_id')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->foreignId('chat_session_id')
                    ->nullable()
                    ->after('client_id')
                    ->constrained('chat_sessions')
                    ->nullOnDelete();
                
                $table->index(['chat_session_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['chat_session_id']);
            $table->dropColumn('chat_session_id');
        });
    }
};