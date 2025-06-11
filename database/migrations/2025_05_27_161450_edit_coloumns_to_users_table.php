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
    //     Schema::table('users', function (Blueprint $table) {
    //         $table->dropColumn('role');
    //     });

    //     Schema::table('users', function (Blueprint $table) {
    //         // Tambahkan kolom baru 'id_role'
    //         $table->unsignedBigInteger('id_role')->after('password');

    //         // Tambahkan foreign key ke tabel roles
    //         $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('cascade');
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    // public function down(): void
    // {
    //     Schema::table('users', function (Blueprint $table) {
    //         $table->dropForeign(['id_role']);
    //         $table->dropColumn('id_role');
    //         $table->string('role')->after('password');
    //     });
    // }
};
