<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->index();
            $table->text('message');
            $table->enum('sender_type', ['user', 'bot', 'admin'])->default('user');
            $table->boolean('is_read')->default(false);
            $table->enum('status', ['sent', 'delivered', 'read'])->default('sent');
            $table->timestamps();
            
            $table->index(['client_id', 'created_at']);
            $table->index(['client_id', 'is_read']);
            $table->index(['sender_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};