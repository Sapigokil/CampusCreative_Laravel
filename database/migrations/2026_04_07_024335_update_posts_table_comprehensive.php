<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('user_id')->constrained()->onDelete('set null');
            $table->string('featured_image')->nullable()->after('slug');
            $table->text('excerpt')->nullable()->after('content');
            $table->string('meta_description')->nullable()->after('excerpt');
            $table->string('tags')->nullable()->after('meta_description');
            $table->integer('reading_time')->nullable()->after('tags');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'featured_image', 'excerpt', 'meta_description', 'tags', 'reading_time']);
        });
    }
};