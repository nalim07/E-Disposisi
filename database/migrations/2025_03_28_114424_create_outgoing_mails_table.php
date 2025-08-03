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
            $table->string('mail_number');
            $table->string('purpose');
            $table->string('subject');
            $table->date('mail_date');
            $table->date('received_date');
            $table->string('file_path');
            $table->string('original_name');
            $table->enum('status', ['Sudah Ditindaklanjuti', 'Arsip'])->default('Sudah Ditindaklanjuti');
            $table->timestamp('archived_at')->nullable();
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
