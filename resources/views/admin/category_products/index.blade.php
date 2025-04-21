@extends('admin.layouts.master')

@section('page-title', 'Danh sách danh mục sản phẩm')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="form-group">
                            <a href="{{ route('category_products.create') }}" class="btn btn-info">Thêm mới danh mục</a>
                        </div>

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên danh mục</th>
                                <th>Slug</th>
                                <th>Trạng thái</th>
                                <th>Danh mục cha</th>
                                <th class="text-center">Hành động</th>
                                <th class="text-center">Xem thêm</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        @if ($category->status)
                                            <span class="badge badge-success">Hoạt động</span>
                                        @else
                                            <span class="badge badge-danger">Không hoạt động</span>
                                        @endif
                                    </td>
                                    <td>{{ $category->parent ? $category->parent->name : 'N/A' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('category_products.edit', $category->id) }}"
                                           class="btn btn-warning btn-sm">Sửa</a>

                                        <form action="{{ route('category_products.destroy', $category->id) }}"
                                              method="POST" class="d-inline-block"
                                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <!-- Icon "Xem thêm" -->
                                        <a href="javascript:void(0);" class="toggle-details">
                                            <i class="fas fa-chevron-down"></i> <!-- Icon mũi tên xuống -->
                                        </a>
                                    </td>
                                </tr>

                                <tr class="expandable-body d-none">
                                    <td colspan="7">
                                        <p style="display: none;">
                                            <strong>Tiêu đề
                                                SEO:</strong> {{ $category->title_seo ?? 'Chưa có tiêu đề SEO' }} <br>
                                            <strong>Mô tả
                                                SEO:</strong> {{ $category->description_seo ?? 'Chưa có mô tả SEO' }}
                                            <br>
                                            <strong>Từ khóa
                                                SEO:</strong> {{ $category->meta_keywords ?? 'Chưa có từ khóa SEO' }}
                                            <br>

                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Hiển thị phân trang nếu có -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Chèn script vào stack 'scripts' -->
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.toggle-details').on('click', function () {
                var nextRow = $(this).closest('tr').next('.expandable-body');
                var icon = $(this).find('i');

                if (nextRow.hasClass('d-none')) {
                    nextRow.removeClass('d-none');
                    nextRow.find('p').slideDown();
                    icon.removeClass('fa-chevron-down').addClass('fa-chevron-up'); // Đổi icon thành mũi tên lên
                } else {
                    nextRow.find('p').slideUp(function () {
                        nextRow.addClass('d-none');
                    });
                    icon.removeClass('fa-chevron-up').addClass('fa-chevron-down'); // Đổi icon thành mũi tên xuống
                }
            });
        });
    </script>
@endpush
