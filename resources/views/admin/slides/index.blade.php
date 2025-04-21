@extends('admin.layouts.master')

@section('page-title', 'Danh sách slide')

@section('content')
    <div class="container">
        <a href="{{ route('slides.create') }}" class="btn btn-info mb-3">Thêm Slide</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr>

                <th>Ảnh</th>
                <th>Thứ tự</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($slides as $slide)
                <tr>
                    <td><img src="{{ asset('images/slides/' . $slide->image) }}" width="150" height="100"></td>
                    <td>{{ $slide->order }}</td>
                    <td>{{ $slide->status ? 'Hiển thị' : 'Ẩn' }}</td>
                    <td>
                        <a href="{{ route('slides.edit', $slide->id) }}" class="btn btn-info btn-sm">Chỉnh sửa</a>
                        <form action="{{ route('slides.destroy', $slide->id) }}" method="POST"
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
