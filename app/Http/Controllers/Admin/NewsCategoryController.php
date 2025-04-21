<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::paginate(10);
        return view('admin.news_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.news_categories.create');
    }

    public function store(Request $request)
    {
        // Validate các trường name và slug
        $request->validate([
            'name' => 'required|unique:news_categories,name',
            'slug' => 'required|unique:news_categories,slug',
            'sort_order' => 'nullable|integer',
        ]);

        // Tạo slug từ name nếu slug không được nhập
        $slug = $request->input('slug') ?: Str::slug($request->input('name'));

        // Tạo danh mục tin tức
        NewsCategory::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'status' => $request->has('status') ? 1 : 0,
            'sort_order' => $request->input('sort_order', 0),
            'is_show_menu' => $request->has('is_show_menu') ? 1 : 0,
            'is_show_home' => $request->has('is_show_home') ? 1 : 0
        ]);

        // Điều hướng về trang danh sách với thông báo thành công
        return redirect()->route('news_categories.index')->with('success', 'Danh mục được tạo thành công.');
    }

    public function edit(NewsCategory $newsCategory)
    {
        return view('admin.news_categories.edit', compact('newsCategory'));
    }

    public function update(Request $request, NewsCategory $newsCategory)
    {
        $request->validate([
            'name' => 'required|unique:news_categories,name,' . $newsCategory->id,
            'slug' => 'required|unique:news_categories,slug,' . $newsCategory->id,
            'sort_order' => 'nullable|integer',
        ]);

        // Tạo slug từ name nếu không được cung cấp
        $data = $request->all();
        if (!$request->filled('slug')) {
            $data['slug'] = Str::slug($request->name);
        }

        // Cập nhật các trường checkbox
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['is_show_menu'] = $request->has('is_show_menu') ? 1 : 0;
        $data['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
        
        // Cập nhật dữ liệu
        $newsCategory->update($data);
        return redirect()->route('news_categories.index')->with('success', 'Danh mục được sửa thành công.');
    }

    public function destroy(NewsCategory $newsCategory)
    {
        $newsCategory->delete();

        return redirect()->route('news_categories.index')->with('success', 'Danh mục được xoá thành công.');
    }
}
