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
        Schema::table('uptd', function (Blueprint $table) {
            $table->renameColumn('id_kendaraan', 'id_uptd');
            $table->renameColumn('wilayah', 'nama_uptd');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('uptd', function (Blueprint $table) {
            $table->renameColumn('id_uptd', 'id_kendaraan');
            $table->renameColumn('nama_uptd', 'wilayah');
        });
    }
};
