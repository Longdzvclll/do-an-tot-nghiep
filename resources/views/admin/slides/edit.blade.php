@extends('admin.layouts.master')
@section('page-title', 'Chỉnh sửa Slide')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('slides.update', $slide->id) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="image">Ảnh</label>
                                <input type="file" name="image"> <br>
                                <img src="{{ asset('images/slides/' . $slide->image) }}" width="150" height="100">
                            </div>

                            <div class="form-group">
                                <label for="order">Thứ tự</label>
                                <input type="number" name="order" class="form-control" value="{{ $slide->order }}">
                            </div>

                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $slide->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                                    <option value="0" {{ $slide->status == 0 ? 'selected' : '' }}>Ẩn</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Cập nhật Slide</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
