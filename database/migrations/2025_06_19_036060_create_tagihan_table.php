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
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_id')->constrained('rental')->onDelete('cascade');
            $table->integer('nomor_invoice')->unique();
            $table->string('keterangan');
            $table->date('tanggal_tagihan');
            $table->integer('jumlah_unit');
            $table->string('durasi_tagih');
            $table->integer('grand_total');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};
