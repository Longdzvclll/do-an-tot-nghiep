@extends('admin.layouts.master')

@section('page-title', 'Chi tiết đơn hàng #' . $order->id)

@section('content')
    <div class="container">
        <div class="order-details">
            <h2 class="mb-4">Thông tin khách hàng</h2>
            <p><strong>Tên:</strong> {{ $order->billing_name }}</p>
            <p><strong>Email:</strong> {{ $order->billing_email }}</p>
            <p><strong>Điện thoại:</strong> {{ $order->billing_phone }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->billing_address }}, {{ $order->billing_city }}</p>

            <h2 class="mt-5 mb-4">Sản phẩm trong đơn hàng</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng cộng</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price) }}₫</td>
                        <td>{{ number_format($item->price * $item->quantity) }}₫</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <h2 class="mt-5 mb-4">Thông tin thanh toán</h2>
            <p><strong>Phương thức thanh toán:</strong> {{ ucfirst($order->payment_method) }}</p>
            <p><strong>Tổng đơn hàng:</strong> {{ number_format($order->total_amount) }}₫</p>

            <h2 class="mt-5 mb-4">Trạng thái đơn hàng</h2>
            @if($order->status !== 'completed')
                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-control">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                    </select>
                    <button type="submit" class="btn btn-success mt-3">Cập nhật trạng thái</button>
                </form>
            @else
                <p><strong>Trạng thái hiện tại:</strong> <span class="badge bg-success">Hoàn thành</span></p>
            @endif

            <a href="{{ route('orders.index') }}" class="btn btn-info mt-4 mb-4">Quay lại danh sách đơn hàng</a>
        </div>
    </div>
@endsection
