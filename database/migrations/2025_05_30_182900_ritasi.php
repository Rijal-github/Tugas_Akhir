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
        Schema::create('ritasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_supir');
            $table->unsignedBigInteger('id_uptd');
            $table->bigInteger('banyak_ritasi');
            $table->bigInteger('netto_pre');
            $table->bigInteger('netto_post');
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();

            
            $table->foreign('id_supir')->references('id_supir')->on('supirs')->onDelete('cascade');
            $table->foreign('id_uptd')->references('id_uptd')->on('uptd')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ritasi');
    }
};
