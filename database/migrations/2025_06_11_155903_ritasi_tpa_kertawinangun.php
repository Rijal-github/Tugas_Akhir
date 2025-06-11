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
        Schema::create('ritasi_tpa_kertawinangun', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_driver');
            $table->bigInteger('banyak_ritasi');
            $table->bigInteger('netto_pre');
            $table->bigInteger('netto_post');
            $table->string('keterangan', 255);
            $table->timestamps();

            
            $table->foreign('id_driver')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ritasi_tpa_kertawinangun');
    }
};
