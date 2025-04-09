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
        Schema::create('incoming_mails', function (Blueprint $table) {
            $table->id();
            $table->string('mail_number'); // nomor_surat
            $table->string('sender'); // pengirim
            $table->string('subject'); // perihal
            $table->date('mail_date'); // tanggal_surat
            $table->date('received_date'); // tanggal_terima
            $table->string('file_path');
            $table->string('status')->default('Belum diteruskan'); // status
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_mails');
    }
};
