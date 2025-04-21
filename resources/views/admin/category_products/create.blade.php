@extends('admin.layouts.master')

@section('page-title', 'Thêm mới danh mục sản phẩm')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('category_products.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">Tên danh mục <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                       placeholder="Nhập tên danh mục" required>
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug (URL) <span class="text-danger">*</span></label>
                                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}"
                                       placeholder="Nhập slug URL" required>
                            </div>

                            <div class="form-group">
                                <label for="title_seo">Tiêu đề SEO</label>
                                <input type="text" name="title_seo" class="form-control" value="{{ old('title_seo') }}"
                                       placeholder="Nhập tiêu đề SEO (nếu có)">
                            </div>

                            <div class="form-group">
                                <label for="description_seo">Mô tả SEO</label>
                                <textarea name="description_seo" class="form-control" rows="3"
                                          placeholder="Nhập mô tả SEO (nếu có)">{{ old('description_seo') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="meta_keywords">Từ khóa SEO</label>
                                <input type="text" name="meta_keywords" class="form-control"
                                       value="{{ old('meta_keywords') }}" placeholder="Nhập từ khóa SEO (nếu có)">
                            </div>

                            <div class="form-group">
                                <label for="meta_keywords">Thứ tự</label>
                                <input type="text" name="sort_order" class="form-control"
                                       value="{{ old('sort_order') }}" placeholder="Thứ tự">
                            </div>


                            <div class="form-group">
                                <label for="parent_id">Danh mục cha</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">Không có</option>
                                    @foreach ($parentCategories as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                        @if($parent->children)
                                            @foreach ($parent->children as $child)
                                                <option value="{{ $child->id }}">-- {{ $child->name }}</option>
                                            @endforeach
                                        @endif
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hoạt động</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Không hoạt động
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="icon">Icon:</label>
                                <input type="text" name="icon" id="icon" class="form-control" placeholder="Icon">
                            </div>

                            <div class="form-group">
                                <label for="is_show_home">Hiển thị trên trang chủ:</label>

                                <!-- Input ẩn với giá trị mặc định là 0 -->
                                <input type="hidden" name="is_show_home" value="0">

                                <!-- Checkbox với giá trị 1 khi được chọn -->
                                <input type="checkbox" name="is_show_home" id="is_show_home" value="1"
                                    {{ old('is_show_home') ? 'checked' : '' }}>
                            </div>

                            <div class="form-group">
                                <label for="is_show_menu">Hiển thị trên menu:</label>

                                <!-- Input ẩn với giá trị mặc định là 0 -->
                                <input type="hidden" name="is_show_menu" value="0">

                                <!-- Checkbox với giá trị 1 khi được chọn -->
                                <input type="checkbox" name="is_show_menu" id="is_show_menu" value="1"
                                    {{ old('is_show_menu') ? 'checked' : '' }}>
                            </div>



                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Lưu danh mục</button>
                                <a href="{{ route('category_products.index') }}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

