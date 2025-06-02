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
        Schema::dropIfExists('uptd');
        Schema::dropIfExists('kendaraan');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
