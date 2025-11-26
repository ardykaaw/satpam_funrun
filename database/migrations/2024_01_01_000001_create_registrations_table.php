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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique()->nullable(); // Nomor yang akan dikirim via WhatsApp
            $table->string('category')->default('Umum');
            
            // Nama
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('bib_name', 16); // Max 16 karakter
            $table->string('phone');
            
            // Data Pribadi
            $table->date('birth_date');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('occupation');
            
            // Identitas
            $table->string('id_type'); // KTP, SIM, Passport, Kartu Pelajar
            $table->string('id_number');
            
            // Alamat
            $table->text('address');
            $table->string('city');
            
            // Jersey & Darah
            $table->string('jersey_size'); // XS, S, M, L, XL, XXL
            $table->string('blood_type');
            
            // Kontak Darurat
            $table->string('emergency_name');
            $table->string('emergency_phone');
            
            // Opsional
            $table->string('community')->nullable();
            $table->text('medical_notes')->nullable();
            
            // Pembayaran
            $table->string('payment_proof_path')->nullable(); // Path ke file bukti pembayaran
            $table->enum('payment_status', ['pending', 'verified', 'rejected'])->default('pending');
            
            // Status
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable(); // Catatan dari admin
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};

