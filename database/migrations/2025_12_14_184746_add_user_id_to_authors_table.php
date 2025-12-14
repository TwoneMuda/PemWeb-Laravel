<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('authors', function (Blueprint $table) {
            // Tambah user_id setelah kolom id
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->onDelete('cascade');
            
            // Hapus kolom name
            $table->dropColumn('name');
        });
    }

    public function down()
    {
        Schema::table('authors', function (Blueprint $table) {
            // Kembalikan kolom name jika di-rollback
            $table->string('name')->nullable();
            
            // Hapus foreign key dan kolom user_id
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
