@extends('admin.layouts.master')

@section('page-title', 'Danh sách danh mục tin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="form-group">
                    <a href="{{ route('news_categories.create') }}" class="btn btn-info mb-3">Thêm mới</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên danh mục</th>
                        <th>Slug</th>
                        <th>Thứ tự</th>
                        <th>Hiển thị Menu</th>
                        <th>Hiển thị Trang chủ</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->sort_order }}</td>
                            <td>{{ $category->is_show_menu == 1 ? 'Có' : 'Không' }}</td>
                            <td>{{ $category->is_show_home == 1 ? 'Có' : 'Không' }}</td>
                            <td>{{ $category->status == 1 ? 'Hiển thị' : 'Ẩn' }}</td>
                            <td>
                                <a href="{{ route('news_categories.edit', $category->id) }}"
                                   class="btn btn-info btn-sm">Sửa</a>
                                <form action="{{ route('news_categories.destroy', $category->id) }}" method="POST"
                                      style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
    {{ $categories->links() }}
@endsection

