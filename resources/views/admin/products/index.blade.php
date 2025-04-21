@extends('admin.layouts.master')

@section('page-title', 'Danh sách sản phẩm')

@section('content')
    <div class="container">
        <!-- Form Lọc sản phẩm -->
        <form action="{{ route('products.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-2">
                    <input type="text" name="sku" class="form-control" placeholder="Mã sản phẩm" value="{{ request('sku') }}">
                </div>
                <!-- Lọc theo tên sản phẩm -->
                <div class="col-md-2">
                    <input type="text" name="name" class="form-control" placeholder="Tên sản phẩm"
                           value="{{ request('name') }}">
                </div>

                <!-- Lọc theo danh mục -->
                <div class="col-md-2">
                    <select name="category" class="form-control">
                        <option value="">Chọn danh mục</option>
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Lọc theo khoảng giá -->
                <div class="col-md-2">
                    <input type="number" name="min_price" class="form-control" placeholder="Giá từ"
                           value="{{ request('min_price') }}">
                </div>
                <div class="col-md-2">
                    <input type="number" name="max_price" class="form-control" placeholder="Giá đến"
                           value="{{ request('max_price') }}">
                </div>

                <!-- Lọc theo tình trạng kho -->
                <div class="col-md-2">
                    <select name="stock_status" class="form-control">
                        <option value="">Tình trạng kho</option>
                        <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>Còn
                            hàng
                        </option>
                        <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>
                            Hết hàng
                        </option>
                    </select>
                </div>

                <!-- Nút tìm kiếm -->
                <div class="col-md-2 mt-2 mt-md-2 d-flex">
                    <button type="submit" class="btn btn-info btn-sm w-50 mr-2">Lọc</button>
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-secondary w-50">Clear</a>
                </div>
            </div>
        </form>

        <!-- Danh sách sản phẩm -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Mã sản phẩm (SKU)</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Danh mục</th>
                                <th>Số lượng còn</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($mainImage = $product->images->where('is_main', 1)->first())
                                            <img src="{{ asset('images/products/' . $mainImage->image_name) }}"
                                                 alt="{{ $product->name }}" class="img-thumbnail"
                                                 style="width: 70px; height: 70px;">
                                        @else
                                            <span>Không có ảnh</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ number_format($product->price) }} ₫</td>
                                    <td>
                                        <!-- Hiển thị danh mục sản phẩm -->
                                        @foreach($product->categories as $category)
                                            <span class="badge badge-info">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $product->stock }}
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}"
                                           class="btn btn-warning btn-sm">Sửa</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                              class="d-inline-block"
                                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
