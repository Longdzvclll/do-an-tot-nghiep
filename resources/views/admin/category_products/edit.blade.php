@extends('admin.layouts.master')

@section('page-title', 'Chỉnh sửa danh mục sản phẩm')

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

                        <form action="{{ route('category_products.update', $categoryProduct->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Tên danh mục <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name', $categoryProduct->name) }}"
                                       placeholder="Nhập tên danh mục" required>
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug (URL) <span class="text-danger">*</span></label>
                                <input type="text" name="slug" class="form-control"
                                       value="{{ old('slug', $categoryProduct->slug) }}"
                                       placeholder="Nhập slug URL" required>
                            </div>

                            <div class="form-group">
                                <label for="title_seo">Tiêu đề SEO</label>
                                <input type="text" name="title_seo" class="form-control"
                                       value="{{ old('title_seo', $categoryProduct->title_seo) }}"
                                       placeholder="Nhập tiêu đề SEO (nếu có)">
                            </div>

                            <div class="form-group">
                                <label for="description_seo">Mô tả SEO</label>
                                <textarea name="description_seo" class="form-control" rows="3"
                                          placeholder="Nhập mô tả SEO (nếu có)">{{ old('description_seo', $categoryProduct->description_seo) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="meta_keywords">Từ khóa SEO</label>
                                <input type="text" name="meta_keywords" class="form-control"
                                       value="{{ old('meta_keywords', $categoryProduct->meta_keywords) }}"
                                       placeholder="Nhập từ khóa SEO (nếu có)">
                            </div>

                            <div class="form-group">
                                <label for="meta_keywords">Thứ tự</label>
                                <input type="text" name="sort_order" class="form-control"
                                       value="{{ old('sort_order', $categoryProduct->sort_order) }}" placeholder="Thứ tự">
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Danh mục cha</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">Không có</option>
                                    @foreach ($parentCategories as $parent)
                                        <option value="{{ $parent->id }}" {{ $categoryProduct->parent_id == $parent->id ? 'selected' : '' }}>
                                            {{ $parent->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status', $categoryProduct->status) == 1 ? 'selected' : '' }}>
                                        Hoạt động
                                    </option>
                                    <option value="0" {{ old('status', $categoryProduct->status) == 0 ? 'selected' : '' }}>
                                        Không hoạt động
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="icon">Icon:</label>
                                <input type="text" placeholder="Icon" name="icon" id="icon" class="form-control" value="{{$categoryProduct->icon}}">
                            </div>
                            <div class="form-group">
                                <label for="is_show_home">Hiển thị trên trang chủ:</label>
                                <input type="checkbox" name="is_show_home" id="is_show_home" value="1"
                                    {{ old('is_show_home', $categoryProduct->is_show_home) ? 'checked' : '' }}>
                            </div>

                            <div class="form-group">
                                <label for="is_show_menu">Hiển thị trên menu:</label>
                                <input type="checkbox" name="is_show_menu" id="is_show_menu" value="1"
                                    {{ old('is_show_menu', $categoryProduct->is_show_menu) ? 'checked' : '' }}>
                            </div>


                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-info">Cập nhật danh mục</button>
                                <a href="{{ route('category_products.index') }}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
