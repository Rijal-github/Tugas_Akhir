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
        Schema::create('tps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('id_uptd');
            $table->string('nama');
            $table->year('tahun');
            $table->string('jenis_tps');
            $table->string('lokasi');
            $table->decimal('latitude', 10, 6);
            $table->decimal('longitude', 10, 6);
            $table->string('keterangan')->nullable();
            $table->string('foto_tps');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_uptd')->references('id_uptd')->on('uptd')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tps');
    }
};
