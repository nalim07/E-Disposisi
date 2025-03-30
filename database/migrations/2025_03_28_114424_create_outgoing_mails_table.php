<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('outgoing_mails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incoming_mail_id')->constrained('incoming_mails');
            $table->foreignId('recipient_id')->constrained('users');
            $table->enum('status', ['followed up', 'archived'])->default('followed up');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_mails');
    }
};
