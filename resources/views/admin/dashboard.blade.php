@extends('admin.layouts.master')

@section('page-title', 'Trang tổng quan')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <section class="container">
        <div class="row">

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $categoryCount }}</h3>
                        <p>Danh mục sản phẩm</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-database"></i>
                    </div>
                    <a href="{{route("category_products.index")}}" class="small-box-footer">Chi tiết<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $orderCount }}</h3>
                        <p>Đơn hàng</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="{{route("orders.index")}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $productCount }}</h3>
                        <p>Sản phẩm</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-boxes"></i>
                    </div>
                    <a href="{{route('products.index')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $newsCount }}</h3>
                        <p>Tin tức</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-newspaper"></i>
                    </div>
                    <a href="{{route("news.index")}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-12">
                        <canvas id="ordersChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container mt-5">
                <h3>Thống kê Đơn Hàng Theo Trạng Thái</h3>
                <canvas id="orderStatusChart" style="width: 500px !important; height: 500px !important;"></canvas>
            </div>

        </div>
        <div class="row">
            <div class="container mt-5">
                <h3>Thống kê Doanh thu Theo Tháng</h3>
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </section>
    <script>
        const ctx = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ctx, {
            type: 'bar', // Loại biểu đồ
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                    'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                datasets: [{
                    label: 'Số lượng đơn hàng',
                    data: @json($monthlyOrders),
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Thống kê đơn hàng theo tháng'
                    }
                }
            }
        });

        const ctxRevenueByMonth = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctxRevenueByMonth, {
            type: 'bar',
            data: {
                labels: [
                    'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                    'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                ],
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: {!! json_encode(array_values($revenueByMonth)) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const orderStatuses = document.getElementById('orderStatusChart').getContext('2d');
        orderStatuses.canvas.width = 500;
        orderStatuses.canvas.height = 500;
        const orderStatusChart = new Chart(orderStatuses, {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_keys($orderStatuses)) !!},
                datasets: [{
                    label: 'Số lượng đơn hàng',
                    data: {!! json_encode(array_values($orderStatuses)) !!},
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',  // Đang xử lý
                        'rgba(75, 192, 192, 0.6)',  // Đã hoàn thành
                        'rgba(255, 99, 132, 0.6)',  // Đã hủy
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,

                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const label = tooltipItem.label || '';
                                const value = tooltipItem.raw || 0;
                                return `${label}: ${value} đơn hàng`;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
