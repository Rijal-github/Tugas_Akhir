<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('permission_role', function (Blueprint $table) {
    //         $table->unsignedBigInteger('id_role');
    //         $table->unsignedBigInteger('permission_id');
    //         $table->primary(['id_role', 'permission_id']);
    //         $table->timestamps();

    //         $table->foreign('id_role')->references('id')->on('roles')->onDelete('cascade');
    //         $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    // public function down(): void
    // {
    //     Schema::dropIfExists('permission_role');
    // }
};
