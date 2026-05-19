<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Menambahkan kolom user_id sebagai relasi ke tabel users
            $table->foreignId('user_id')->after('id')->nullable()->constrained()->onDelete('cascade');
            
            // Mengubah enum status untuk mendukung 'archived'
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->change();
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};