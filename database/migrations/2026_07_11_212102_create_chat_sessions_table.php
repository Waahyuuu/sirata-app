<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->unique();
            $table->string('nim')->nullable();
            $table->string('nama_mahasiswa')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('email')->nullable();
            $table->enum('status', ['guest', 'parent'])->default('guest');
            $table->timestamps();
            
            $table->index(['client_id']);
            $table->index(['status']);
            $table->index(['nim']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_sessions');
    }
};