<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index()
    {
        $categories = CategoryProduct::with('parent')->paginate(30);
        return view('admin.category_products.index', compact('categories'));
    }

    // Hiển thị form tạo mới danh mục
    public function create()
    {
        // Lấy danh sách danh mục cha để chọn khi tạo mới danh mục con
        $parentCategories = CategoryProduct::whereNull('parent_id')->get();
        return view('admin.category_products.create', compact('parentCategories'));
    }

    // Lưu danh mục mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:category_products',
            'slug' => 'required|unique:category_products',
        ]);

        CategoryProduct::create($request->all());
        return redirect()->route('category_products.index')->with('success', 'Danh mục sản phẩm đã được tạo.');
    }

    // Hiển thị form chỉnh sửa danh mục
    public function edit(CategoryProduct $categoryProduct)
    {
        $parentCategories = CategoryProduct::whereNull('parent_id')->get();
        return view('admin.category_products.edit', compact('categoryProduct', 'parentCategories'));
    }

    // Cập nhật danh mục
    public function update(Request $request, CategoryProduct $categoryProduct)
    {
        $request->validate([
            'name' => 'required|unique:category_products,name,' . $categoryProduct->id,
            'slug' => 'required|unique:category_products,slug,' . $categoryProduct->id,
        ]);

        $data = $request->all();
        $data['is_show_menu'] = $request->has('is_show_menu') ? 1 : 0;
        $data['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
        $categoryProduct->update($data);
        return redirect()->route('category_products.index')->with('success', 'Danh mục sản phẩm đã được cập nhật.');
    }

    // Xóa danh mục
    public function destroy(CategoryProduct $categoryProduct)
    {
        $categoryProduct->delete();
        return redirect()->route('category_products.index')->with('success', 'Danh mục sản phẩm đã bị xóa.');
    }

    public function showCategory($slug, Request $request)
    {
        // Lấy danh mục cha và các danh mục con
        $categories = CategoryProduct::with(['children.products', 'products'])->whereNull('parent_id')->get();

        foreach ($categories as $category) {
            $totalProducts = $category->products->count();
            foreach ($category->children as $child) {
                $totalProducts += $child->products->count();
            }
            $category->total_products_count = $totalProducts;
        }

        // Lấy danh mục theo slug
        $category = CategoryProduct::where('slug', $slug)->with('children')->firstOrFail();

        // Lấy giá trị `min_price` và `max_price` từ request (giá trị mặc định là 0 và 10 triệu)
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', 10000000);


        // Tạo mảng chứa các ID của danh mục cha và các danh mục con
        $categoryIds = $category->children->pluck('id')->toArray();
        $categoryIds[] = $category->id; // Bao gồm cả ID của danh mục cha

        // Truy vấn sản phẩm dựa trên khoảng giá và danh mục
        $productsQuery = Product::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('category_id', $categoryIds);
        });

        // Lọc sản phẩm theo khoảng giá
        $productsQuery->whereBetween('price', [$minPrice, $maxPrice]);

        // Xử lý sắp xếp sản phẩm nếu có yêu cầu
        $orderBy = $request->input('orderby', 'id');
        switch ($orderBy) {
            case 'date':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'price':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $productsQuery->orderBy('price', 'desc');
                break;
            default:
                $productsQuery->orderBy('id', 'desc');
                break;
        }

        // Phân trang sản phẩm
        $products = $productsQuery->paginate(12);

        // Breadcrumbs
        $breadcrumbs = collect();
        $currentCategory = $category;
        while ($currentCategory) {
            $breadcrumbs->prepend([
                'name' => $currentCategory->name,
                'slug' => $currentCategory->slug,
            ]);
            $currentCategory = $currentCategory->parent;
        }

        $currentCategory = CategoryProduct::where('slug', $slug)->with('parent')->first();

        // Trả về view và truyền dữ liệu danh mục và sản phẩm
        return view('frontend.category.show', compact('category', 'categories', 'products', 'breadcrumbs', 'orderBy', 'minPrice', 'maxPrice','currentCategory'));
    }




}
