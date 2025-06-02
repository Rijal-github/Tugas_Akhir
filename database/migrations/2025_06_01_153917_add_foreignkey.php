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
        // Schema::table('tps', function (Blueprint $table) {
        //     // Tambahkan kolom baru 'id_uptd'
        //     $table->unsignedBigInteger('id_uptd')->after('jumlah');

        //     // Tambahkan foreign key ke tabel tps
        //     $table->foreign('id_uptd')->references('id_uptd')->on('uptd')->onDelete('cascade');
        // });

        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom baru 'id_uptd'
            $table->unsignedBigInteger('no_hp')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('tps', function (Blueprint $table) {
        //     $table->dropForeign(['id_uptd']);
        //     $table->dropColumn('id_uptd');
        // });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('no_hp');
        });
    }
};
