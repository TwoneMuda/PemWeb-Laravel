<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. (MENAMBAH KOLOM)
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // Pindahkan kode ini ke sini:
            $table->string('status')->default('draft'); 
            $table->text('rejection_note')->nullable();
        });
    }

    /**
     * Reverse the migrations. (MENGHAPUS KOLOM)
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // Saat rollback, kita hapus kolomnya
            $table->dropColumn(['status', 'rejection_note']);
        });
    }
};