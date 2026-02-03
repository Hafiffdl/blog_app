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
        // Remove icon from mst_ki
        Schema::table('mst_ki', function (Blueprint $table) {
            $table->dropColumn('icon');
        });

        // Remove wajib_diisi from mst_syarat_ki
        Schema::table('mst_syarat_ki', function (Blueprint $table) {
            $table->dropColumn('wajib_diisi');
        });

        // Remove form_data from trx_usulan_ki
        Schema::table('trx_usulan_ki', function (Blueprint $table) {
            $table->dropColumn('form_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back icon to mst_ki
        Schema::table('mst_ki', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('nama');
        });

        // Add back wajib_diisi to mst_syarat_ki
        Schema::table('mst_syarat_ki', function (Blueprint $table) {
            $table->boolean('wajib_diisi')->default(true)->after('value');
        });

        // Add back form_data to trx_usulan_ki
        Schema::table('trx_usulan_ki', function (Blueprint $table) {
            $table->json('form_data')->nullable()->after('deskripsi');
        });
    }
};
