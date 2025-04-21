@extends("frontend.layouts.master")
@section('title', 'Giỏ hàng - LẮC FOODS')
@section("content")
    <style>
        .page-content {
            padding-top: 50px;
            padding-bottom: 50px;
            background-color: #f8f9fa;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .quantity-selector .btn {
            width: 40px;
            height: 40px;
        }

        .quantity-selector input[type="number"] {
            max-width: 60px;
        }

    </style>
    <div class="woo-page-header page-header-8">
        <ul class="breadcrumb text-center">
            <li class="current">
                <a href="{{route('cart.view')}}">Giỏ hàng</a>
            </li>
            <li class="">
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


                    <div id="content" role="main">

                        <article class="post-6 page type-page status-publish hentry">

                            <h2 class="entry-title" style="display: none;">Giỏ hàng</h2>

                            <div class="page-content">
                                <div class="woocommerce container py-5">

                                    @if (\Cart::isEmpty())
                                        <div class="cart-empty-page text-center">
                                            <div class="woocommerce-notices-wrapper mb-3"></div>
                                            <i class="cart-empty porto-icon-bag-2 mb-3" style="font-size: 80px; color: #aaa;"></i>
                                            <p class="px-3 py-2 cart-empty">No products added to the cart</p>
                                            <p class="return-to-shop">
                                                <a class="btn btn-primary btn-go-shop" href="{{ asset('/') }}">
                                                    Quay trở lại cửa hàng
                                                </a>
                                            </p>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <form action="{{ route('cart.update') }}" method="POST">
                                                    @csrf
                                                    <table class="table table-bordered align-middle text-center">
                                                        <thead class="table-light">
                                                        <tr>
                                                            <th>Ảnh</th>
                                                            <th>Sản phẩm</th>
                                                            <th>Giá</th>
                                                            <th>Số lượng</th>
                                                            <th>Tạm tính</th>
                                                            <th>Xóa</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($cartItems as $item)
                                                            <tr>
                                                                <td class="product-thumbnail">
                                                                    <img src="{{ asset('images/products/' . $item->attributes->image) }}"
                                                                         alt="{{ $item->name }}"
                                                                         class="img-fluid" style="max-width: 80px;">
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('product.show', $item->id) }}">{{ $item->name }}</a>
                                                                </td>
                                                                <td>{{ number_format($item->price) }}₫</td>
                                                                <td>
                                                                    <div class="input-group quantity-selector">
                                                                        <input type="hidden" name="ids[]" value="{{ $item->id }}">
                                                                        <input type="number" name="quantities[]" class="form-control text-center"
                                                                               value="{{ $item->quantity }}" min="1">
                                                                    </div>
                                                                </td>
                                                                <td>{{ number_format($item->price * $item->quantity) }}₫</td>
                                                                <td>
                                                                    <button type="button" class="btn btn-danger"
                                                                            onclick="removeItem({{ $item->id }})">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <button type="submit" class="btn btn-dark w-100 mb-3">
                                                        Cập nhật giỏ hàng
                                                    </button>
                                                </form>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Cộng giỏ hàng</h5>
                                                        <table class="table">
                                                            <tr>
                                                                <th>Tạm tính</th>
                                                                <td>{{ number_format(\Cart::getTotal()) }}₫</td>
                                                            </tr>
                                                            <tr class="order-total">
                                                                <th>Tổng tiền</th>
                                                                <td><strong>{{ number_format(\Cart::getTotal()) }}₫</strong></td>
                                                            </tr>
                                                        </table>
                                                        <a href="{{ route('checkout') }}" class="btn btn-success w-100">
                                                            Tiến hành thanh toán <i class="fa fa-arrow-right ps-2"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

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
