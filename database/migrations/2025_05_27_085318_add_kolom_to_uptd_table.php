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
            $table->string('wilayah')->after('jenis_kendaraan');
            $table->text('keterangan')->after('wilayah');
            $table->decimal('kapasitas_angkutan', 8, 2)->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('uptd', function (Blueprint $table) {
            $table->dropColumn(['wilayah', 'keterangan', 'kapasitas_angkutan']);
        });
    }
};
