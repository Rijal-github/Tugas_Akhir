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
        Schema::table('ritasi_tpa_pecuk', function (Blueprint $table) {
            $table->unsignedBigInteger('id_vehicle')->nullable()->after('id_driver');

            $table->foreign('id_vehicle')->references('id')->on('vehicle')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ritasi_tpa_pecuk', function (Blueprint $table) {
            $table->dropForeign(['id_vehicle']);
            $table->dropColumn('id_vehicle');
        });
    }
};
