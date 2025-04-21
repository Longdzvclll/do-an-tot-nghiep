@extends("frontend.layouts.master")
@section('title', 'Sản phẩm - LẮC FOODS')
@section('description', 'Sản phẩm - LẮC FOODS')
@section("images", asset("images/logo.png"))

@section("content")
    <section class="page-top page-header-5">
        <div class="container hide-title">
            <div class="row align-items-center">
                <div class="breadcrumbs-wrap col-lg-6">
                    <span class="yoast-breadcrumbs"><span><a href="{{asset("/")}}">Home</a></span> » <span
                            class="breadcrumb_last" aria-current="page">Sản phẩm</span></span>
                </div>
                <div class="text-end d-none col-lg-6">
                    <h1 class="page-title">Sản phẩm</h1>
                </div>
            </div>
        </div>
    </section>

    <div id="main" class="column2 column2-left-sidebar boxed"><!-- main -->

        <div class="container">
            <div class="row main-content-wrap">
                <!-- main content -->
                <div class="main-content col-lg-9">

                    <div id="primary" class="content-area">
                        <main id="content" class="site-main" style="min-height: 0px;">


                            <div class="woocommerce-notices-wrapper"></div>
                            <div class="shop-loop-before" style="opacity: 1;"><a href="#"
                                                                                 class="porto-product-filters-toggle sidebar-toggle d-inline-flex d-lg-none">
                                    <svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <line class="cls-1" x1="15" x2="26" y1="9" y2="9"></line>
                                        <line class="cls-1" x1="6" x2="9" y1="9" y2="9"></line>
                                        <line class="cls-1" x1="23" x2="26" y1="16" y2="16"></line>
                                        <line class="cls-1" x1="6" x2="17" y1="16" y2="16"></line>
                                        <line class="cls-1" x1="17" x2="26" y1="23" y2="23"></line>
                                        <line class="cls-1" x1="6" x2="11" y1="23" y2="23"></line>
                                        <path class="cls-2"
                                              d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"></path>
                                        <path class="cls-2" d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z"></path>
                                        <path class="cls-3" d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z"></path>
                                        <path class="cls-2"
                                              d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"></path>
                                    </svg>
                                    <span>Filter</span></a>
                                <form class="woocommerce-ordering" method="GET" id="sortForm">
                                    <label for="orderby">Sắp xếp theo: </label>
                                    <select name="orderby" class="orderby" aria-label="Đơn hàng của cửa hàng"
                                            onchange="document.getElementById('sortForm').submit();">
                                        <option
                                            value="menu_order" {{ request('orderby') == 'menu_order' ? 'selected' : '' }}>
                                            Thứ tự mặc định
                                        </option>
                                        <option value="date" {{ request('orderby') == 'date' ? 'selected' : '' }}>Mới
                                            nhất
                                        </option>
                                        <option value="price" {{ request('orderby') == 'price' ? 'selected' : '' }}>Giá
                                            từ thấp đến cao
                                        </option>
                                        <option
                                            value="price-desc" {{ request('orderby') == 'price-desc' ? 'selected' : '' }}>
                                            Giá từ cao xuống thấp
                                        </option>
                                    </select>
                                    <input type="hidden" name="paged" value="1">
                                </form>

                                <nav class="woocommerce-pagination">
                                    <form class="woocommerce-viewing" method="get">

                                        <label>Hiển thị: </label>

                                        <select name="count" class="count">
                                            <option value="12" selected="selected">12</option>
                                            <option value="24">24</option>
                                            <option value="36">36</option>
                                        </select>

                                        <input type="hidden" name="paged" value="">

                                    </form>
                                    <ul class="page-numbers">
                                        {{ $products->appends(['orderby' => request('orderby')])->links() }}
                                    </ul>
                                </nav>

                            </div>
                            <div class="archive-products">
                                <div class="yit-wcan-container">
                                    <ul class="products products-container grid pcols-lg-4 pcols-md-3 pcols-xs-3 pcols-ls-2 pwidth-lg-4 pwidth-md-3 pwidth-xs-2 pwidth-ls-1"
                                        data-product_layout="product-outimage_aq_onimage">
                                        @foreach($products as $product)
                                            <li class="product-col product-outimage_aq_onimage product type-product post-3416 status-publish first instock product_cat-ket-khach-san product_tag-ket-khach-san-kks01 product_tag-ket-sat-khach-san-kks01 product_tag-ket-sat-kks01 product_tag-ket-sat-the-one-kks01 product_tag-kks01 has-post-thumbnail taxable shipping-taxable purchasable product-type-simple">
                                                <div class="product-inner">

                                                    <div class="product-image">

                                                        <a title="{{ $product->name }}"
                                                           href="{{route("product.show", $product->slug)}}">
                                                            <div class="inner"><img width="300" height="300"
                                                                                    src="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                                                    class=" wp-post-image"
                                                                                    alt="{{ $product->name }}"
                                                                                    decoding="async"></div>
                                                        </a>
                                                        <div class="links-on-image">
                                                            <div class="add-links-wrap">
                                                                <div
                                                                    class="add-links no-effect clearfix">
                                                                    <a href="javascript:void(0);"
                                                                       data-product_id="{{ $product->id }}"
                                                                       data-quantity="1"
                                                                       class="viewcart-style-3 button wp-element-button product_type_simple add_to_cart_button"
                                                                       aria-label="Thêm &ldquo;{{ $product->name }}&rdquo; vào giỏ hàng"
                                                                       rel="nofollow">Thêm
                                                                        vào giỏ hàng</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="product-content">
                                                        @if($product->categories->isNotEmpty())
                                                            <span class="category-list">
        @foreach($product->categories as $category)
                                                                    <a href="{{ route('category.products', $category->slug) }}"
                                                                       rel="tag">{{ $category->name }}</a>@if(!$loop->last), @endif
                                                                @endforeach
    </span>
                                                        @endif

                                                        <a class="product-loop-title" title="{{ $product->name }}"
                                                           href="{{route("product.show", $product->slug)}}">
                                                            <h3 class="woocommerce-loop-product__title">{{ $product->name }}</h3>
                                                        </a>


                                                        <span class="price"><span
                                                                class="woocommerce-Price-amount amount"><bdi>{{ number_format($product->price) }}&nbsp;<span
                                                                        class="woocommerce-Price-currencySymbol">₫</span></bdi></span></span>

                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>

                            </div>
                            <div class="shop-loop-after clearfix" style="opacity: 1;">
                                <nav class="woocommerce-pagination">
                                    <form class="woocommerce-viewing" method="get">

                                        <label>Hiển thị: </label>

                                        <select name="count" class="count">
                                            <option value="12" selected="selected">12</option>
                                            <option value="24">24</option>
                                            <option value="36">36</option>
                                        </select>

                                        <input type="hidden" name="paged" value="">

                                    </form>
                                    <ul class="page-numbers">
                                        {{ $products->appends(['orderby' => request('orderby')])->links() }}

                                    </ul>
                                </nav>
                            </div>
                        </main>
                    </div>

                </div><!-- end main content -->

                <div class="sidebar-overlay"></div>
                <div class="col-lg-3 sidebar porto-woo-category-sidebar left-sidebar mobile-sidebar">
                    <!-- main sidebar -->
                    <div class="pin-wrapper" style="height: 771.945px;">
                        <div data-plugin-sticky=""
                             data-plugin-options="{&quot;autoInit&quot;: true, &quot;minWidth&quot;: 992, &quot;containerSelector&quot;: &quot;.main-content-wrap&quot;,&quot;autoFit&quot;:true, &quot;paddingOffsetBottom&quot;: 10}"
                             style="border-bottom: 0px none rgb(0, 0, 0); width: 236px;">
                            <div class="sidebar-content">
                                <aside id="woocommerce_product_categories-2"
                                       class="widget woocommerce widget_product_categories">
                                    <h3 class="widget-title">Danh mục<span class="toggle"></span></h3>
                                    <ul class="product-categories">
                                        @foreach ($categories as $category_sub)
                                            <li class="cat-item cat-item-{{$category_sub->id}} cat-parent
    {{ isset($currentCategory) && ($currentCategory->id === $category_sub->id || $currentCategory->parent_id === $category_sub->id) ? 'current' : '' }}">
                                                <a title="{{$category_sub->name}}"
                                                   href="{{ route('category.products', $category_sub->slug) }}">
                                                    {{$category_sub->name}}
                                                </a>
                                                <span class="count">({{ $category_sub->totalProductsCount() }})</span>

                                                @if ($category_sub->children->count() > 0)
                                                    <span class="toggle"></span>
                                                    <ul class="children">
                                                        @foreach ($category_sub->children as $child)
                                                            <li class="cat-item cat-item-{{$child->id}}
                    {{ isset($currentCategory) && $currentCategory->id === $child->id ? 'current' : '' }}">
                                                                <a href="{{ route('category.products', $child->slug) }}"
                                                                   title="{{ $child->name }}">
                                                                    {{ $child->name }}
                                                                </a>
                                                                <span
                                                                    class="count">({{ $child->totalProductsCount() }})</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>

                                        @endforeach
                                    </ul>
                                </aside>
                                <aside id="woocommerce_price_filter-2"
                                       class="widget woocommerce widget_price_filter yith-wcan-list-price-filter">
                                    <h3 class="widget-title">Lọc theo giá<span class="toggle"></span></h3>
                                    <form method="GET" action="">
                                        <div class="price_slider_wrapper">
                                            <div id="slider-range"
                                                 class="price_slider ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"></div>
                                            <div class="price_slider_amount" data-step="10">
                                                <label for="min_price">Giá thấp nhất</label>
                                                <input type="text" id="min_price" name="min_price"
                                                       value="{{ request('min_price') ?? 0 }}" style="border:0;">
                                                <label for="max_price">Giá cao nhất</label>
                                                <input type="text" id="max_price" name="max_price"
                                                       value="{{ request('max_price') ?? 10000000 }}" style="border:0;">
                                                <button type="submit" class="button">Lọc</button>
                                                <div class="price_label">
                                                    Giá <span class="from">{{ number_format(request('min_price', 0), 0, ',', '.') }} ₫</span>
                                                    —
                                                    <span class="to">{{ number_format(request('max_price', 10000000), 0, ',', '.') }} ₫</span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </aside>
                            </div>
                        </div>
                    </div>

                </div><!-- end main sidebar -->

            </div>
        </div>

    </div>
@endsection

@section("script")
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function () {

            $('.cat-parent .toggle').on('click', function () {
                var children = $(this).siblings('.children');
                children.slideToggle();  // Ẩn/hiện danh mục con
                $(this).closest('.cat-parent').toggleClass('open');  // Thêm hoặc xóa lớp 'open'
            });
        });

        $(function () {
            // Hàm format giá tiền VND
            function formatCurrency(value) {
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " ₫";
            }

            // Thiết lập ban đầu cho slider giá
            $("#slider-range").slider({
                range: true,
                min: 0, // Giá thấp nhất có thể kéo
                max: 100000000, // Giá cao nhất có thể kéo
                values: [{{ request('min_price', 0) }}, {{ request('max_price', 10000000) }}], // Giá trị ban đầu
                slide: function (event, ui) {
                    // Khi kéo thanh slider, cập nhật giá trị input
                    $("#min_price").val(ui.values[0]);
                    $("#max_price").val(ui.values[1]);

                    // Hiển thị giá đã format trên màn hình
                    $(".from").text(formatCurrency(ui.values[0]));
                    $(".to").text(formatCurrency(ui.values[1]));
                }
            });

            // Thiết lập giá trị ban đầu trong input khi tải trang
            $("#min_price").val($("#slider-range").slider("values", 0));
            $("#max_price").val($("#slider-range").slider("values", 1));

            // Hiển thị giá trị ban đầu đã format trên màn hình
            $(".from").text(formatCurrency($("#slider-range").slider("values", 0)));
            $(".to").text(formatCurrency($("#slider-range").slider("values", 1)));
        });
    </script>
@endsection
