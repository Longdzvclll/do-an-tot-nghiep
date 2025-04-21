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
        // Kiểm tra và rename cột trước khi thêm cột mới
        if (Schema::hasColumn('news_categories', 'is_active')) {
            Schema::table('news_categories', function (Blueprint $table) {
                $table->renameColumn('is_active', 'status');
            });
        }

        // Sau đó mới thêm các cột is_show_menu, is_show_home, status nếu cần
        Schema::table('news_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('news_categories', 'is_show_menu')) {
                $table->boolean('is_show_menu')->default(0)->after('sort_order');
            }

            if (!Schema::hasColumn('news_categories', 'is_show_home')) {
                $table->boolean('is_show_home')->default(0)->after('is_show_menu');
            }

            if (!Schema::hasColumn('news_categories', 'status')) {
                $table->boolean('status')->default(1)->after('is_show_home');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news_categories', function (Blueprint $table) {
            if (Schema::hasColumn('news_categories', 'is_show_menu')) {
                $table->dropColumn('is_show_menu');
            }
            if (Schema::hasColumn('news_categories', 'is_show_home')) {
                $table->dropColumn('is_show_home');
            }
        });

        // Đổi tên cột ngược lại
        if (Schema::hasColumn('news_categories', 'status') && !Schema::hasColumn('news_categories', 'is_active')) {
            Schema::table('news_categories', function (Blueprint $table) {
                $table->renameColumn('status', 'is_active');
            });
        }
    }
};
