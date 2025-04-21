@extends("frontend.layouts.master")
@section('title', 'LẮC FOODS - Ẩm thực Việt Nam ngon - sạch - tươi')
@section('description', 'LẮC FOODS - Nhà hàng ẩm thực Việt Nam với đa dạng món ăn ngon, sạch, tươi. Đặt món online nhanh chóng, giao hàng tận nơi.')
@section('keywords', 'LẮC FOODS, ẩm thực Việt Nam, đặt món online, món ăn Việt Nam, nhà hàng, giao hàng tận nơi')
@section("images", asset("images/logo.png"))
@section('og:type', 'website')
@section('og:url', url('/'))
@section('og:title', 'LẮC FOODS - Ẩm thực Việt Nam ngon - sạch - tươi')
@section('og:description', 'LẮC FOODS - Nhà hàng ẩm thực Việt Nam với đa dạng món ăn ngon, sạch, tươi. Đặt món online nhanh chóng, giao hàng tận nơi.')
@section('og:image', asset("images/logo.png"))
@section('twitter:card', 'summary_large_image')
@section('twitter:title', 'LẮC FOODS - Ẩm thực Việt Nam ngon - sạch - tươi')
@section('twitter:description', 'LẮC FOODS - Nhà hàng ẩm thực Việt Nam với đa dạng món ăn ngon, sạch, tươi. Đặt món online nhanh chóng, giao hàng tận nơi.')
@section('twitter:image', asset("images/logo.png"))
@section("content")
    <style>

        .news-item {
            margin-bottom: 30px;
        }

        .news-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .news-content {
            margin-top: 10px;
        }

        .news-content h4 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .news-date {
            font-size: 14px;
            color: #888;
        }

        .news-excerpt {
            font-size: 14px;
        }

    </style>
    <h1 class="hidden">Lacfoods.vn</h1>
    <section id="home-slider" class="section section-slider">
        <div class="owl-carousel">
            @foreach($slides as $slide)
                <div class="item ">
                    <picture>
                        <source media="(max-width: 767px)"
                                srcset="{{ asset("images/slides/".$slide->image) }}">
                        <source media="(min-width: 768px)"
                                srcset="{{ asset("images/slides/".$slide->image) }}">
                        <img src="{{ asset("images/slides/".$slide->image) }}" alt="">
                    </picture>
                </div>
            @endforeach
        </div>
    </section>

    <section id="home-search" class="section-search">
        <div class="container">
            <div class="search-box wpo-wrapper-search">
                <form action="/search" class="searchform searchform-categoris ultimate-search">
                    <div class="wpo-search-inner">
                        <input type="hidden" name="type" value="product"/>
                        <input required id="inputSearchAuto" name="q" maxlength="40" autocomplete="off"
                               class="searchinput input-search search-input" type="text" size="20"
                               placeholder="Tìm món..." aria-label="Search">
                    </div>
                    <button type="submit" class="btn-search btn" id="search-header-btn" aria-label="Tìm kiếm">
                        <svg version="1.1" class="svg search" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 27"
                             style="enable-background:new 0 0 24 27;" xml:space="preserve"><path
                                d="M10,2C4.5,2,0,6.5,0,12s4.5,10,10,10s10-4.5,10-10S15.5,2,10,2z M10,19c-3.9,0-7-3.1-7-7s3.1-7,7-7s7,3.1,7,7S13.9,19,10,19z"></path>
                            <rect x="17" y="17" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -9.2844 19.5856)"
                                  width="4" height="8"></rect></svg>
                    </button>
                </form>

            </div>
        </div>
    </section>

    <section id="home-tablist" class="section section-tablist">
        <div class="container-fluid">
            <div class="wrapper-heading">
                <h2 class="has-line">THỰC ĐƠN NGON - ĐẶT MÓN NGAY</h2>
            </div>


            @foreach($categoriesWithProducts as $category)
                <div class="home-tablist--nav" style="margin-top: 40px">
                    <ul>
                        <li class="active">
                            <a style="text-transform: uppercase"
                               href="{{ route('category.products', $category->slug) }}" class="">
                                {{ $category->name }}
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="home-tablist--tab">
                    <div class="home-tablist--col">
                        <div id="home_tab_0">
                            <div class="content-product-list row">
                                @foreach($category->allProducts as $product)
                                    <div class="product-loop col-md-3 col-xs-6">
                                        <div class="product-block product-resize">
                                            <div class="product-img">
                                                <a href="{{ route("product.show", $product->slug) }}"
                                                   title="{{ $product->name }}" class="image-resize ratiobox">
                                                    <picture>
                                                        <source media="(max-width: 480px)"
                                                                data-srcset="{{ asset('images/products/' . $product->mainImage->image_name) }}"/>
                                                        <source media="(min-width: 481px) and (max-width: 767px)"
                                                                data-srcset="{{ asset('images/products/' . $product->mainImage->image_name) }}"/>
                                                        <source media="(min-width: 768px)"
                                                                data-srcset="{{ asset('images/products/' . $product->mainImage->image_name) }}"/>
                                                        <img class="lazyload img-loop" data-sizes="auto"
                                                             data-src="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                             data-lowsrc="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                             src="{{ asset('images/products/placeholder.png') }}"
                                                             alt="{{ $product->name }}"/>
                                                    </picture>
                                                </a>
                                            </div>
                                            <div class="product-detail">
                                                <h3 class="product-name">
                                                    <a href="{{ route("product.show", $product->slug) }}"
                                                       title="{{ $product->name }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </h3>
                                                <div class="product-action">
                                                    <div class="box-product-prices">
                                                        <div class="product-price">
                                                            <span>{{ number_format($product->price) }}₫</span>
                                                        </div>
                                                    </div>
                                                    <div class="button-add">
                                                        <button type="submit" data-product_id="{{ $product->id }}"
                                                                class="action pro-btn-order"
                                                                data-link="{{ route("product.show", $product->slug) }}">
                                                            Đặt món
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    <!-- Hiển thị tin tức giống như danh mục món ăn -->
    <section id="home-tablist" class="section section-tablist">
        <div class="container-fluid">
            <div class="wrapper-heading">
                <h2 class="has-line">TIN TỨC & KHUYẾN MÃI</h2>
            </div>

            @foreach($newsCategoriesHome as $newsCategory)
                <div class="home-tablist--nav" style="margin-top: 40px">
                    <ul>
                        <li class="active">
                            <a style="text-transform: uppercase"
                               href="{{ route('category.news', $newsCategory->slug) }}" class="">
                                {{ $newsCategory->name }}
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="home-tablist--tab">
                    <div class="home-tablist--col">
                        <div id="home_tab_{{ $newsCategory->id }}">
                            <div class="content-product-list row">
                                @foreach($newsCategory->news()->where('status', 1)->orderBy('id', 'DESC')->take(4)->get() as $news)
                                    <div class="product-loop col-md-3 col-xs-6">
                                        <div class="product-block product-resize">
                                            <div class="product-img">
                                                <a href="{{ route('news.detail', $news->slug) }}"
                                                   title="{{ $news->title }}" class="image-resize ratiobox">
                                                    <picture>
                                                        <source media="(max-width: 480px)"
                                                                data-srcset="{{ asset('images/news/' . $news->image) }}"/>
                                                        <source media="(min-width: 481px) and (max-width: 767px)"
                                                                data-srcset="{{ asset('images/news/' . $news->image) }}"/>
                                                        <source media="(min-width: 768px)"
                                                                data-srcset="{{ asset('images/news/' . $news->image) }}"/>
                                                        <img class="lazyload img-loop" data-sizes="auto"
                                                             data-src="{{ asset('images/news/' . $news->image) }}"
                                                             data-lowsrc="{{ asset('images/news/' . $news->image) }}"
                                                             src="{{ asset('images/products/placeholder.png') }}"
                                                             alt="{{ $news->title }}"/>
                                                    </picture>
                                                </a>
                                            </div>
                                            <div class="product-detail">
                                                <h3 class="product-name">
                                                    <a href="{{ route('news.detail', $news->slug) }}"
                                                       title="{{ $news->title }}">
                                                        {{ $news->title }}
                                                    </a>
                                                </h3>
                                                <div class="product-action">
                                                    <div class="box-product-prices">
                                                        <div class="product-price">
                                                            <span>{{ $news->created_at->format('d/m/Y') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section id="working-hours" class="section section-working">
        <div class="container">
            <div class="working-row">
                <div class="working-inner">
                    <div class="wrapper-heading">
                        <h2 class="has-line">Thời gian mở cửa</h2>
                    </div>
                    <div class="qode-advanced-pricing-list">
                        <div class="qode-apl-items">


                            <div class="qode-apl-item">
                                <div class="qode-apl-item-top">
                                    <h5 class="qode-apl-item-title">Thứ 2 - Chủ Nhật</h5>
                                    <div class="qode-apl-line"></div>
                                    <h5 class="qode-apl-item-price">8:30am - 23:00pm</h5>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="home-quick-order" class="section section-quick-order">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="quick_order">
                        <h2 class="title">Liên hệ để đặt món</h2>
                        <div class="content"><a href="tel:0839004889">0839 004 889</a></div>
                    </div>
                </div>


                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="subscribe">
                        <h2>Đăng ký thông tin nhượng quyền </h2>
                        <div class="subscribe-content">
                            <p>Đăng ký để được cập nhật thông tin mới nhất về chính sách nhượng quyền
                                <br>
                                LẮC BOX</p>
                            <div class="form-newsletter">
                                <form accept-charset='UTF-8' action='/account/contact' class='contact-form'
                                      method='post'>
                                    <input name='form_type' type='hidden' value='customer'>
                                    <input name='utf8' type='hidden' value='✓'>

                                    <div class="form-group">
                                        <input required type="email" value=""
                                               placeholder="Vui lòng nhập email của bạn!" name="contact[email]"
                                               class="inputNew form-control newsletter-input">
                                        <button type="submit" class="submitNewsletter"></button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


