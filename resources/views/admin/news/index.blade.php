@extends('admin.layouts.master')

@section('page-title', 'Danh sách tin')
@section('content')
    <div class="container">
        <div class="form-group">
            <a href="{{ route('news.create') }}" class="btn btn-info">Thêm tin tức mới</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Danh mục</th>
                <th>Ảnh đại diện</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($news as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td><img src="{{ asset('images/news/' . $item->image) }}" width="100"></td>
                    <td>{{ $item->status ? 'Hiển thị' : 'Ẩn' }}</td>
                    <td>
                        <a href="{{ route('news.edit', $item->id) }}" class="btn btn-info btn-sm">Sửa</a>
                        <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $news->links() }}
    </div>
@endsection
