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
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_read')->default(false);
            $table->string('status')->default('bot');
            $table->timestamps();
            $table->index(['client_id', 'created_at']);
            $table->index(['client_id', 'is_read']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
