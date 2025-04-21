@extends('admin.layouts.master')

@section('page-title', 'Thêm mới danh mục tin')

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
                        <form action="{{ route('news_categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên danh mục</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug (nếu để trống sẽ tự tạo từ tên)</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
                                @if ($errors->has('slug'))
                                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="sort_order">Thứ tự sắp xếp</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}">
                                @if ($errors->has('sort_order'))
                                    <span class="text-danger">{{ $errors->first('sort_order') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="status" name="status" checked>
                                    <label class="form-check-label" for="status">Kích hoạt</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="is_show_menu" name="is_show_menu">
                                    <label class="form-check-label" for="is_show_menu">Hiển thị trên menu</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="is_show_home" name="is_show_home">
                                    <label class="form-check-label" for="is_show_home">Hiển thị trên trang chủ</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title_seo">Tiêu đề SEO</label>
                                <input type="text" class="form-control" id="title_seo" name="title_seo" value="{{ old('title_seo') }}">
                                <small class="form-text text-muted">Tiêu đề hiển thị trên Google (để trống sẽ dùng tên danh mục)</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="description_seo">Mô tả SEO</label>
                                <textarea class="form-control" id="description_seo" name="description_seo" rows="3">{{ old('description_seo') }}</textarea>
                                <small class="form-text text-muted">Mô tả hiển thị trên kết quả tìm kiếm Google</small>
                            </div>

                            <button type="submit" class="btn btn-info">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
