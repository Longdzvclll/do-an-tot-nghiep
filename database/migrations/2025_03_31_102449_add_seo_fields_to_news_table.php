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
        Schema::table('news', function (Blueprint $table) {
            if (!Schema::hasColumn('news', 'title_seo')) {
                $table->string('title_seo')->nullable();
            }
            if (!Schema::hasColumn('news', 'description_seo')) {
                $table->text('description_seo')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $columns = ['title_seo', 'description_seo'];
            $table->dropColumn(array_filter($columns, fn($column) => Schema::hasColumn('news', $column)));
        });
    }
};