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
        Schema::create('uptd', function (Blueprint $table) {
            $table->bigIncrements('id_uptd');
            $table->string('nama_uptd');
            $table->string('alamat_uptd');
            $table->string('foto_uptd')->nullable();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uptd');
    }
};
