<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('status', 1)
            ->orderBy('created_at', 'desc')->paginate(12);

        // Trả về view kèm danh sách tin tức
        return view('frontend.news.index', compact('news'));
    }

    public function newDetail($slug)
    {
       $news = News::where("slug", $slug)->first();
        $recentPosts = News::orderBy('created_at', 'desc')->take(5)->get();

        return view('frontend.news.detail', compact('news','recentPosts'));
    }

    public function listNewsByCategory($slug)
    {
        // Tìm danh mục dựa trên slug
        $category = NewsCategory::where('slug', $slug)->firstOrFail();

        // Lấy danh sách tin tức thuộc danh mục này
        $newsList = News::where('news_category_id', $category->id)->paginate(12);


        // Trả về view cùng với danh sách tin tức và thông tin danh mục
        return view('frontend.news.category-news', compact('category', 'newsList'));
    }
}
