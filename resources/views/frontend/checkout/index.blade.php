@extends("frontend.layouts.master")
@section('title', 'Thanh toán - LẮC FOODS')
@section("content")
    <style>
        #content {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
        }

        .table {
            margin-top: 15px;
        }

        .table td{
            padding: 10px !important;
        }
        .btn-dark {
            background-color: #343a40;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-dark:hover {
            background-color: #23272b;
        }

        .form-control, .form-check-label {
            font-size: 16px;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
        }

    </style>
    <div class="woo-page-header page-header-8">
        <ul class="breadcrumb text-center">
            <li class="">
                <a href="{{route('cart.view')}}">Giỏ hàng</a>
            </li>
            <li class="current">
                <i class="delimiter delimiter-2"></i>
                <a href="{{route('checkout')}}">Thanh toán</a>
            </li>
            <li class="disable">
                <i class="delimiter delimiter-2"></i>
                <a href="#" class="nolink">Đặt hàng</a>
            </li>
        </ul>
    </div>
    <div id="main" class="column1 boxed"><!-- main -->

        <div class="container">
            <div class="row main-content-wrap">

                <!-- main content -->
                <div class="main-content col-lg-12">


                    <div id="content" role="main" class="container py-5">
                        <article class="post-7 page type-page status-publish hentry">
                            <div class="page-content">
                                <div class="woocommerce">
                                    <div class="woocommerce-notices-wrapper mb-4"></div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form name="checkout" method="post" class="checkout"
                                          action="{{ route('checkout.store') }}" enctype="multipart/form-data"
                                          novalidate>
                                        @csrf
                                        <div class="row" id="customer_details">
                                            <!-- Thông tin khách hàng -->
                                            <div class="col-lg-7 mb-4">
                                                <h3>Thông tin thanh toán</h3>
                                                <div class="box-content">
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="billing_first_name" class="form-label">Tên
                                                                    <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                       name="billing_first_name"
                                                                       id="billing_first_name"
                                                                       value="{{ old('billing_first_name') }}"
                                                                       autocomplete="given-name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="billing_last_name" class="form-label">Họ
                                                                    <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                       name="billing_last_name"
                                                                       id="billing_last_name"
                                                                       value="{{ old('billing_last_name') }}"
                                                                       autocomplete="family-name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="billing_address_1" class="form-label">Địa
                                                                    chỉ <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                       name="billing_address_1"
                                                                       id="billing_address_1" placeholder="Địa chỉ"
                                                                       value="{{ old('billing_address_1') }}"
                                                                       autocomplete="address-line1" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="billing_city" class="form-label">Tỉnh /
                                                                    Thành phố <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                       name="billing_city"
                                                                       id="billing_city"
                                                                       value="{{ old('billing_city') }}"
                                                                       autocomplete="address-level2" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="billing_phone" class="form-label">Số điện
                                                                    thoại <span class="text-danger">*</span></label>
                                                                <input type="tel" class="form-control"
                                                                       name="billing_phone"
                                                                       id="billing_phone"
                                                                       value="{{ old('billing_phone') }}"
                                                                       autocomplete="tel" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="billing_email" class="form-label">Địa chỉ
                                                                    email <span class="text-danger">*</span></label>
                                                                <input type="email" class="form-control"
                                                                       name="billing_email"
                                                                       id="billing_email"
                                                                       value="{{ old('billing_email') }}"
                                                                       autocomplete="email" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="order_comments" class="form-label">Ghi chú
                                                                    đơn hàng (tuỳ chọn)</label>
                                                                <textarea class="form-control" name="order_comments"
                                                                          id="order_comments" rows="3"
                                                                          placeholder="Ghi chú về đơn hàng"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Đơn hàng -->
                                            <div class="col-lg-5">
                                                <h3>Đơn hàng của bạn</h3>
                                                <table class="table table-bordered">
                                                    <thead class="table-light">
                                                    <tr>
                                                        <th>Sản phẩm</th>
                                                        <th>Thành tiền</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($cartItems as $item)
                                                        <tr>
                                                            <td>{{ $item->name }} x {{ $item->quantity }}</td>
                                                            <td>{{ number_format($item->price * $item->quantity) }}₫
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Tổng</th>
                                                        <td><strong>{{ number_format($cartTotal) }}₫</strong></td>
                                                    </tr>
                                                    </tfoot>
                                                </table>

                                                <h4 class="mt-4">Phương thức thanh toán</h4>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="payment_method"
                                                           id="cod" value="cod" checked>
                                                    <label class="form-check-label" for="cod">
                                                        Trả tiền mặt khi nhận hàng
                                                    </label>
                                                </div>

                                                <button type="submit" class="btn btn-primary w-100 mt-4 py-2">
                                                    Đặt hàng
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </article>
                    </div>


                </div><!-- end main content -->

                <div class="sidebar-overlay"></div>

            </div>
        </div>

    </div>
@endsection
