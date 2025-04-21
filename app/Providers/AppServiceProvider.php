<?php

namespace App\Providers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\CategoryProduct;
use Cart;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        View::composer('frontend.*', function ($view) {
            $categories = CategoryProduct::whereNull('parent_id')
                ->where("is_show_menu", 1)
                ->where('status', 1)
                ->with(['children' => function($query) {
                    $query->where('status', 1)
                          ->where('is_show_menu', 1)
                          ->orderBy('sort_order', 'ASC');
                }])
                ->orderBy('sort_order', 'ASC')
                ->get();
            $otherCategories = CategoryProduct::whereNull('parent_id')
                ->where("is_show_menu", 0)
                ->where('status', 1)
                ->orderBy('sort_order', 'ASC')
                ->get();
            
            // Lấy danh mục tin tức có trạng thái hoạt động và hiển thị trên menu
            $newsCategories = NewsCategory::where('status', 1)
                ->where('is_show_menu', 1)
                ->orderBy('sort_order', 'ASC')
                ->get();
                
            $view->with(compact('categories', 'otherCategories', 'newsCategories'));
        });


        View::composer('frontend.layouts.header', function ($view) {
            // Lấy số sản phẩm và danh sách sản phẩm trong giỏ
            $cartItemsCount = Cart::getContent()->count();
            $cartItems = Cart::getContent();

            // Chia sẻ cả số lượng sản phẩm và danh sách sản phẩm tới view
            $view->with('cartItemsCount', $cartItemsCount)
                ->with('cartItems', $cartItems);
        });

        View::composer('frontend.layouts.news-sidebar', function ($view) {
            $recentPosts = News::orderBy('created_at', 'desc')->take(5)->get();
            $cateNews = NewsCategory::all();

            $view->with('cateNews', $cateNews)
                ->with('recentPosts', $recentPosts);
        });
    }
}
