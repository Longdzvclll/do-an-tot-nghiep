@extends('admin.layouts.master')

@section('page-title', 'Danh sách đơn hàng')

@section('content')
    <div class="container">
        <form action="{{ route('orders.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <label for="status">Trạng thái:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Tất cả</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                        </select>
                    </div>
                </div>

                <div class="col-2">
                    <div class="form-group">
                        <label for="start_date">Từ ngày:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                </div>

                <div class="col-2">
                    <div class="form-group">
                        <label for="end_date">Đến ngày:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                </div>

                <div class="col-2">
                    <div class="form-group">
                        <label for="billing_phone">Số điện thoại:</label>
                        <input type="text" name="billing_phone" id="billing_phone" class="form-control" value="{{ request('billing_phone') }}">
                    </div>
                </div>

                <div class="col-2">
                    <div class="form-group">
                        <label for="billing_email">Email:</label>
                        <input type="email" name="billing_email" id="billing_email" class="form-control" value="{{ request('billing_email') }}">
                    </div>
                </div>

                <div class="col-2">
                    <div class="form-group">
                        <label for="billing_name">Tên khách hàng:</label>
                        <input type="text" name="billing_name" id="billing_name" class="form-control" value="{{ request('billing_name') }}">
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-info">Lọc đơn hàng</button>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>



    @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->billing_name }}</td>
                    <td>{{ $order->billing_email }}</td>
                    <td>{{ $order->billing_phone }}</td>
                    <td>{{ $order->billing_address }}, {{ $order->billing_city }}</td>
                    <td>{{ number_format($order->total_amount) }} ₫</td>
                    <td>
                        @switch($order->status)
                            @case('pending')
                                Chờ xử lý
                                @break
                            @case('processing')
                                Đang xử lý
                                @break
                            @case('completed')
                                Hoàn thành
                                @break
                            @case('cancelled')
                                Đã hủy
                                @break
                            @default
                                Không xác định
                        @endswitch
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Xem</a>
                        {{--                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Sửa</a>--}}
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');">Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    </div>

@endsection
