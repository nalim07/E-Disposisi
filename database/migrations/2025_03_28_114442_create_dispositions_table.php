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
        Schema::create('dispositions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incoming_mail_id')->constrained('incoming_mails');
            $table->foreignId('recipient_id')->constrained('users'); // previously tujuan_id
            $table->text('content'); // isi
            $table->date('deadline'); // batas_waktu
            $table->text('notes')->nullable(); // catatan
            $table->string('priority'); // sifat
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositions');
    }
};
