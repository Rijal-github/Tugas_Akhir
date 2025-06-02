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
            $table->bigIncrements('id_kendaraan');
            $table->unsignedBigInteger('id_supir');
            $table->string('no_polisi');
            $table->string('jenis_kendaraan');
            $table->string('wilayah');
            $table->text('keterangan');
            $table->decimal('kapasitas_angkutan', 8, 2);
            $table->timestamps();
        
            $table->foreign('id_supir')->references('id_supir')->on('supirs')->onDelete('cascade');
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
