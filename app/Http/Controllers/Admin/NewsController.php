<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::with('category')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = NewsCategory::all();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:news,title',
            'slug' => 'required|unique:news,slug',
            'content' => 'required',
            'news_category_id' => 'required|exists:news_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sapo' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        // Upload image
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/news'), $imageName);
            $data['image'] = $imageName;
        }

        News::create($data);

        return redirect()->route('news.index')->with('success', 'Tạo tin thành công.');
    }

    public function edit(News $news)
    {
        $categories = NewsCategory::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|unique:news,title,' . $news->id,
            'slug' => 'required|unique:news,slug,' . $news->id,
            'content' => 'required',
            'news_category_id' => 'required|exists:news_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sapo' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        // Upload new image if exists
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/news'), $imageName);
            $data['image'] = $imageName;
        }

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'Sửa tin thành công.');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')->with('success', 'Xoá tin thành công.');
    }
}
