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
             // Hapus foreign key constraint terlebih dahulu
            //  $table->dropForeign(['id_supir']);

            // $table->dropColumn('id_supir');
            $table->dropColumn('no_polisi');
            $table->dropColumn('jenis_kendaraan');
            $table->dropColumn('keterangan');
            $table->dropColumn('kapasitas_angkutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('uptd', function (Blueprint $table) {
            // $table->unsignedBigInteger('id_supir');
            $table->string('no_polisi');
            $table->string('jenis_kendaraan');
            $table->text('keterangan');
            $table->decimal('kapasitas_angkutan', 8, 2);

             // Tambah kembali foreign key (pastikan tabel `supirs` memang ada)
            $table->foreign('id_supir')->references('id_supir')->on('supirs')->onDelete('cascade');
        });
    }
};
