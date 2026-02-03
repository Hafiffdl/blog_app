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
        Schema::create('mst_syarat_ki', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mst_ki_id')->constrained('mst_ki')->onDelete('cascade');
            $table->string('nama');
            $table->string('tipe'); // text, textarea, file, select, date, etc
            $table->text('value')->nullable(); // for select options (JSON)
            $table->boolean('wajib_diisi')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_syarat_ki');
    }
};
