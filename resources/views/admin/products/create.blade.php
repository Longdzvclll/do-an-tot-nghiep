@extends('admin.layouts.master')

@section('page-title', 'Thêm mới sản phẩm')

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

                        <!-- Form thêm sản phẩm -->
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Tên sản phẩm -->
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm" value="{{ old('name') }}" required>
                            </div>

                            <!-- Mã sản phẩm (SKU) -->
                            <div class="form-group">
                                <label for="sku">Mã sản phẩm (SKU)</label>
                                <input type="text" name="sku" class="form-control" placeholder="Nhập mã sản phẩm" value="{{ old('sku') }}" required>
                            </div>

                            <!-- Giá sản phẩm -->
                            <div class="form-group">
                                <label for="price">Giá <small class="text-muted">(₫)</small></label>
                                <input type="number" step="0.01" name="price" class="form-control" placeholder="Nhập giá sản phẩm" value="{{ old('price') }}" required>
                            </div>

                            <!-- Số lượng tồn kho -->
                            <div class="form-group">
                                <label for="stock">Số lượng</label>
                                <input type="number" name="stock" class="form-control" placeholder="Nhập số lượng tồn kho" value="{{ old('stock') }}" required>
                            </div>

                            <!-- Danh mục sản phẩm -->
                            <div class="form-group">
                                <label for="categories">Danh mục</label>
                                <select name="categories[]" class="form-control select2" multiple="multiple" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ (collect(old('categories'))->contains($category->id)) ? 'selected':'' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Mô tả sản phẩm -->
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea id="description" name="description" class="form-control" placeholder="Nhập mô tả sản phẩm">{{ old('description') }}</textarea>
                            </div>
                            <script>
                                CKEDITOR.replace('description');
                            </script>

                            <!-- Nội dung chi tiết sản phẩm -->
                            <div class="form-group">
                                <label for="content">Nội dung chi tiết</label>
                                <textarea id="content" name="content" class="form-control" placeholder="Nhập nội dung chi tiết sản phẩm">{{ old('content') }}</textarea>
                            </div>
                            <script>
                                CKEDITOR.replace('content');
                            </script>

                            <!-- Hình ảnh sản phẩm -->
                            <div class="form-group">
                                <label for="main_image">Ảnh đại diện</label>
                                <input required type="file" name="main_image" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="detail_images">Ảnh chi tiết</label>
                                <input type="file" name="detail_images[]" class="form-control-file" multiple>
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

<!-- Khởi tạo Select2 -->
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Chọn danh mục",
                allowClear: true
            });
        });
    </script>
@endpush
