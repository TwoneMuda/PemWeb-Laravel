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
        Schema::table('authors', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->after('id') // Sebaiknya after id, bukan after name (karena name mau dihapus)
                ->constrained('users') // Otomatis connect ke tabel users
                ->onDelete('cascade'); // Opsional: hapus author jika user dihapus
            $table->dropColumn('name');
        });
    }
};
