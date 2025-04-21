<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('sku') && !empty($request->sku)) {
            $query->where('sku', 'like', '%' . $request->sku . '%');
        }

        // Lọc theo tên sản phẩm
        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Lọc theo danh mục
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('category_id', $request->category);
            });
        }

        // Lọc theo khoảng giá
        if ($request->has('min_price') && !empty($request->min_price)) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && !empty($request->max_price)) {
            $query->where('price', '<=', $request->max_price);
        }

        // Lọc theo tình trạng kho
        if ($request->has('stock_status')) {
            if ($request->stock_status == 'in_stock') {
                $query->where('stock', '>', 0);
            } elseif ($request->stock_status == 'out_of_stock') {
                $query->where('stock', '=', 0);
            }
        }

        $products = $query->orderBy('id', 'DESC');
        // Thực hiện phân trang
        $products = $query->paginate(10);  // Hiển thị 10 sản phẩm mỗi trang
        $categories = CategoryProduct::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = CategoryProduct::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sku' => 'required|unique:products',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Ảnh đại diện
            'detail_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Ảnh chi tiết
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);


        $product = Product::create($data);

        // Lưu ảnh đại diện
        if ($request->hasFile('main_image')) {
            $imageName = time() . '-main.' . $request->main_image->extension();
            $request->main_image->move(public_path('images/products'), $imageName);
            ProductImage::create([
                'product_id' => $product->id,
                'image_name' => $imageName,
                'is_main' => 1, // Đánh dấu ảnh đại diện
            ]);
        }

        // Lưu ảnh chi tiết
        if ($request->hasFile('detail_images')) {
            foreach ($request->file('detail_images') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images/products'), $imageName);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_name' => $imageName,
                    'is_main' => 0, // Ảnh chi tiết
                ]);
            }
        }

        $product->categories()->sync($request->categories);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm thành công');
    }


    public function edit(Product $product)
    {
        $categories = CategoryProduct::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sku' => 'required|unique:products,sku,' . $product->id,
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ảnh đại diện không bắt buộc
            'detail_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'  // Ảnh chi tiết không bắt buộc
        ]);

        // Cập nhật thông tin sản phẩm
        $product->update($request->all());

        // Cập nhật ảnh đại diện
        if ($request->hasFile('main_image')) {
            // Xóa ảnh đại diện cũ nếu có
            if ($product->images()->where('is_main', 1)->exists()) {
                $mainImage = $product->images()->where('is_main', 1)->first();
                if (File::exists(public_path('images/products/' . $mainImage->image_name))) {
                    File::delete(public_path('images/products/' . $mainImage->image_name));
                }
                $mainImage->delete();
            }

            // Lưu ảnh đại diện mới
            $imageName = time() . '-main.' . $request->main_image->extension();
            $request->main_image->move(public_path('images/products'), $imageName);
            ProductImage::create([
                'product_id' => $product->id,
                'image_name' => $imageName,
                'is_main' => 1, // Đánh dấu là ảnh đại diện
            ]);
        }

        // Thêm ảnh chi tiết mới nếu có
        if ($request->hasFile('detail_images')) {
            foreach ($request->file('detail_images') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images/products'), $imageName);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_name' => $imageName,
                    'is_main' => 0, // Ảnh chi tiết
                ]);
            }
        }


        // Cập nhật danh mục sản phẩm
        $product->categories()->sync($request->categories);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật thành công');
    }



    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa');
    }

    public function listProducts(Request $request)
    {
        $orderBy = $request->input('orderby', 'id');

        $productsQuery = Product::query();
        switch ($orderBy) {
            case 'date':
                $productsQuery->orderBy('created_at', 'desc'); // Sort by newest
                break;
            case 'price':
                $productsQuery->orderBy('price', 'asc'); // Sort by price low to high
                break;
            case 'price-desc':
                $productsQuery->orderBy('price', 'desc'); // Sort by price high to low
                break;
            default:
                $productsQuery->orderBy('id', 'desc'); // Default sorting
                break;
        }

        // Filter by price range if provided
        $minPrice = $request->input('min_price', 0); // Default min price
        $maxPrice = $request->input('max_price', 100000000); // Default max price

        $productsQuery->whereBetween('price', [$minPrice, $maxPrice]);

        // Paginate the products
        $products = $productsQuery->paginate(12);

        return view('frontend.product.index', compact('products'));
    }


    public function showProduct($slug)
    {
        // Tìm sản phẩm theo slug
        $product = Product::where('slug', $slug)->firstOrFail();
        $category = $product->categories()->first();

        $categoryIds = $product->categories->pluck('id');
        $relatedProducts = Product::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('category_id', $categoryIds);
        })
            ->where('id', '!=', $product->id)
            ->take(10) // Limit to 10 products
            ->get();

        // Trả về view cùng với dữ liệu sản phẩm
        return view('frontend.product.show', compact('product','category','relatedProducts'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('s');
        $orderBy = $request->input('orderby', 'id'); // Default sorting
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', 100000000); // Set max price or an upper limit

        // Initialize query
        $productsQuery = Product::where('name', 'like', '%' . $searchTerm . '%')
            ->whereBetween('price', [$minPrice, $maxPrice]);

        // Apply sorting
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

        // Paginate products
        $products = $productsQuery->paginate(12);

        // Return view with products and search term
        return view('frontend.product.search', compact('products', 'searchTerm', 'minPrice', 'maxPrice', 'orderBy'));
    }


}
