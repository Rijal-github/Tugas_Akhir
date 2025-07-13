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
        Schema::create('bukti_transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_vehicle');
            $table->unsignedBigInteger('id_operator');
            $table->string('foto_nota');
            $table->string('nama_produk');
            $table->decimal('volume', 8, 2); // volume dalam liter
            $table->timestamps();

            $table->foreign('id_vehicle')->references('id')->on('vehicle')->onDelete('cascade');
            $table->foreign('id_operator')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_transaksis');
    }
};
