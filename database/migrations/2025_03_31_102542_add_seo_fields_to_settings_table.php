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
        if (Schema::hasTable('settings')) {
            Schema::table('settings', function (Blueprint $table) {
                if (!Schema::hasColumn('settings', 'news_title_seo')) {
                    $table->string('news_title_seo')->nullable();
                }
                if (!Schema::hasColumn('settings', 'news_description_seo')) {
                    $table->text('news_description_seo')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('settings')) {
            Schema::table('settings', function (Blueprint $table) {
                $columns = ['news_title_seo', 'news_description_seo'];
                $table->dropColumn(array_filter($columns, fn($column) => Schema::hasColumn('settings', $column)));
            });
        }
    }
};