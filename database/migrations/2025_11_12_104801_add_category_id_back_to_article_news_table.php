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
        Schema::table('article_news', function (Blueprint $table) {
            
            // 1. Tambahkan kolomnya dan IZINKAN NULL
            $table->foreignId('category_id')
                  ->after('is_featured')
                  ->nullable(); // <-- INI YANG PALING PENTING

            // 2. Tambahkan foreign key constraint-nya
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::table('article_news', function (Blueprint $table) {
            // Hapus lagi jika di-rollback
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};