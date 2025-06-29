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
       Schema::create('pengiriman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detailasset_id')->constrained('detailasset')->onDelete('cascade');
            $table->date('tanggal_pengiriman');
            $table->string('pic_pengirim');
            $table->string('pic_penerima');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
