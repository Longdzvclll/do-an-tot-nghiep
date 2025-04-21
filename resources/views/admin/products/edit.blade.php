@extends('admin.layouts.master')

@section('page-title', 'Chỉnh sửa sản phẩm')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <!-- Hiển thị lỗi nếu có -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Form chỉnh sửa sản phẩm -->
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Tên sản phẩm -->
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                            </div>

                            <!-- Mã sản phẩm (SKU) -->
                            <div class="form-group">
                                <label for="sku">Mã sản phẩm (SKU)</label>
                                <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}" required>
                            </div>

                            <!-- Giá sản phẩm -->
                            <div class="form-group">
                                <label for="price">Giá <small class="text-muted">(₫)</small></label>
                                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                            </div>

                            <!-- Số lượng tồn kho -->
                            <div class="form-group">
                                <label for="stock">Số lượng</label>
                                <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
                            </div>

                            <!-- Danh mục sản phẩm -->
                            <div class="form-group">
                                <label for="categories">Danh mục</label>
                                <select name="categories[]" class="form-control select2" multiple="multiple" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Mô tả sản phẩm -->
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                                <script>
                                    CKEDITOR.replace('description');
                                </script>
                            </div>

                            <!-- Nội dung chi tiết sản phẩm -->
                            <div class="form-group">
                                <label for="content">Nội dung chi tiết</label>
                                <textarea name="content" class="form-control">{{ old('content', $product->content) }}</textarea>
                                <script>
                                    CKEDITOR.replace('content');
                                </script>
                            </div>

                            <!-- Ảnh đại diện -->
                            <div class="form-group">
                                <label for="main_image">Ảnh đại diện</label>
                                <input type="file" name="main_image" class="form-control-file">
                                @if($mainImage = $product->images->where('is_main', 1)->first())
                                    <p>Ảnh hiện tại: <img src="{{ asset('images/products/' . $mainImage->image_name) }}" alt="Main Image" class="img-thumbnail" style="width: 100px;"></p>
                                @endif
                            </div>


                            <!-- Ảnh chi tiết -->
                            <div class="form-group">
                                <label for="detail_images">Ảnh chi tiết</label>
                                <input type="file" name="detail_images[]" class="form-control-file" multiple>

                                <div class="mt-2">
                                    @foreach($product->images->where('is_main', 0) as $image)
                                        <div class="image-container" style="display:inline-block; position:relative;">
                                            <img src="{{ asset('images/products/' . $image->image_name) }}" alt="Detail Image" class="img-thumbnail" style="width: 100px;">
                                            <!-- Nút xóa -->
                                            <button type="button" class="btn btn-danger btn-sm delete-image" data-image-id="{{ $image->id }}" style="position:absolute;top:0;right:0;">X</button>
                                        </div>
                                    @endforeach
                                </div>

                            </div>

                            <!-- Nút Lưu sản phẩm -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Lưu sản phẩm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Chọn danh mục",
                allowClear: true
            });


            // Handle delete image using AJAX
            $('.delete-image').on('click', function() {
                var imageId = $(this).data('image-id');
                var token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token

                if (confirm('Bạn có chắc muốn xóa ảnh này không?')) {
                    $.ajax({
                        url: '/admin/product_images/delete/' + imageId,
                        type: 'GET',
                        data: {
                            "_token": token
                        },
                        success: function(response) {
                            alert('Ảnh đã được xóa thành công!');
                            location.reload(); // Reload page to reflect changes
                        },
                        error: function(xhr) {
                            alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
                        }
                    });
                }
            });
        });
    </script>
@endpush
