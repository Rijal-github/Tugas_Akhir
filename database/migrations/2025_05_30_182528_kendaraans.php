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
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->bigIncrements('id_kendaraan');
            $table->unsignedBigInteger('id_uptd');
            $table->string('no_polisi');
            $table->string('jenis_kendaraan');
            $table->decimal('kapasitas_angkutan', 8, 2);
            $table->timestamps();

            $table->foreign('id_uptd')->references('id_uptd')->on('uptd')->onDelete('cascade');
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
