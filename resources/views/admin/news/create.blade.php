@extends('admin.layouts.master')

@section('page-title', 'Thêm mới tin tức')

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

                        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Tiêu đề</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                            </div>

                            <div class="form-group">
                                <label for="news_category_id">Danh mục</label>
                                <select name="news_category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sapo">Sapo (Mô tả ngắn)</label>
                                <textarea name="sapo" class="form-control">{{ old('sapo') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="content">Nội dung</label>
                                <textarea name="content" id="editor"
                                          class="form-control">{{ old('content') }}</textarea>

                            </div>

                            <div class="form-group">
                                <label for="image">Ảnh đại diện</label>
                                <input type="file" name="image" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title_seo">Tiêu đề SEO</label>
                                <input type="text" name="title_seo" class="form-control" value="{{ old('title_seo') }}">
                                <small class="form-text text-muted">Tiêu đề hiển thị trên Google (để trống sẽ dùng tiêu đề tin tức)</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="description_seo">Mô tả SEO</label>
                                <textarea name="description_seo" class="form-control" rows="3">{{ old('description_seo') }}</textarea>
                                <small class="form-text text-muted">Mô tả hiển thị trên kết quả tìm kiếm Google (để trống sẽ dùng sapo)</small>
                            </div>

                            <button type="submit" class="btn btn-info">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('assets/admin/ckeditor/ckeditor.js') }}"></script>
    <script>
        // Khởi tạo CKEditor và tích hợp CKFinder
        CKEDITOR.replace('editor', {
            filebrowserBrowseUrl: '{{ asset('assets/admin/ckfinder/ckfinder.html') }}',
            filebrowserUploadUrl: '{{ asset('assets/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageBrowseUrl: '{{ asset('assets/admin/ckfinder/ckfinder.html?type=Images') }}',
            filebrowserImageUploadUrl: '{{ asset('assets/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}'
        });
    </script>
@endpush

