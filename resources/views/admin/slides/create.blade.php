@extends('admin.layouts.master')
@section('page-title', 'Thêm Slide mới')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('slides.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="image">Ảnh</label> <br>
                                <input type="file" name="image">
                            </div>

                            <div class="form-group">
                                <label for="order">Thứ tự</label>
                                <input type="number" name="order" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Thêm Slide</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
