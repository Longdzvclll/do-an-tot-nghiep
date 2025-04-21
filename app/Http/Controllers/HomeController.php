<?php

namespace App\Http\Controllers;


use App\Models\News;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\Slide;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = CategoryProduct::with('children', 'products')->whereNull('parent_id')
            ->where("is_show_home", 1)
            ->orderBy('sort_order', 'ASC')
            ->get();

        $categoriesWithProducts = [];
        foreach ($categories as $category) {
            $category->allProducts = $this->getAllProductsFromCategoryAndChildren($category);
            $categoriesWithProducts[] = $category;
        }

        $slides = Slide::where('status', 1)->orderBy('order', 'asc')->get();
        $latestNews = News::where('status', 1)->orderBy('created_at', 'DESC')->take(6)->get();
        
        // Lấy danh mục tin tức có trạng thái hoạt động và hiển thị trên trang chủ
        $newsCategoriesHome = NewsCategory::with('news')
            ->where('status', 1)
            ->where('is_show_home', 1)
            ->orderBy('sort_order', 'ASC')
            ->get();
            
        // Lấy danh mục tin tức hiển thị trên menu
        $newsCategories = NewsCategory::where('status', 1)
            ->where('is_show_menu', 1)
            ->orderBy('sort_order', 'ASC')
            ->get();

        return view('frontend.home.index', compact('categories', 'slides', 'categoriesWithProducts', 'latestNews', 'newsCategories', 'newsCategoriesHome'));
    }

    private function getAllProductsFromCategoryAndChildren($category)
    {
        // Lấy sản phẩm của danh mục hiện tại qua bảng trung gian
        $products = $category->products()->with('mainImage')->orderBy('id', 'DESC')->get();

        // Tải danh mục con với điều kiện is_show_home = 1
        $category->load(['children' => function ($query) {
            $query->where('is_show_home', 1)->orderBy('sort_order', 'ASC');
        }]);

        // Đệ quy lấy sản phẩm từ tất cả các danh mục con có is_show_home = 1
        foreach ($category->children as $child) {
            $products = $products->merge($this->getAllProductsFromCategoryAndChildren($child));
        }
        
        // Sắp xếp lại theo ID giảm dần sau khi đã gộp tất cả sản phẩm
        return $products->sortByDesc('id');
    }
}
