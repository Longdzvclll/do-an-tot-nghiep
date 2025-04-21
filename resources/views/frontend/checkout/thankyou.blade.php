@extends("frontend.layouts.master")
@section("content")
    <div class="woo-page-header page-header-8">
        <ul class="breadcrumb text-center">
            <li class="">
                <a href="{{route('cart.view')}}">Giỏ hàng</a>
            </li>
            <li class="">
                <i class="delimiter delimiter-2"></i>
                <a href="{{route('checkout')}}">Thanh toán</a>
            </li>
            <li class="current">
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

                        <article class="post-7 page type-page status-publish hentry">

                            <h2 class="entry-title" style="display: none;">Đơn hàng đã nhận</h2>

                            <div class="page-content">
                                <div class="woocommerce">
                                    <div class="woocommerce-order woocommerce-thankyou col-lg-8 mx-auto px-0" style="min-height: 200px">


                                        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received line-height-md text-center text-v-dark">
                                            <i class="fa fa-check me-2"></i>Cảm ơn bạn. Đơn hàng của bạn đã được nhận.
                                        </p>



                                    </div>
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
