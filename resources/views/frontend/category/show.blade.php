@extends("frontend.layouts.master")
@section('title', $category->title_seo.' - LẮC FOODS')
@section('description', $category->description_seo)
@section("images", asset("images/logo.png"))

@section('styles')
<style>
    .submenu-links {
        display: none;
        padding-left: 15px;
    }
    
    .has-submenu.active > .submenu-links {
        display: block;
    }
    
    .icon-plus-submenu {
        float: right;
        position: relative;
        width: 15px;
        height: 15px;
    }
    
    .icon-plus-submenu:before,
    .icon-plus-submenu:after {
        content: '';
        position: absolute;
        background-color: #333;
        transition: transform 0.25s ease-out;
    }
    
    /* Horizontal line */
    .icon-plus-submenu:before {
        top: 7px;
        left: 0;
        width: 100%;
        height: 1px;
    }
    
    /* Vertical line */
    .icon-plus-submenu:after {
        top: 0;
        left: 7px;
        width: 1px;
        height: 100%;
    }
    
    .has-submenu.active > a .icon-plus-submenu:after {
        transform: rotate(90deg);
    }
    
    .submenu-links li {
        margin: 8px 0;
    }
    
    .menuList-links > li {
        margin-bottom: 10px;
    }
</style>
@endsection

@section("content")

    <div class="breadcrumb-shop">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd5  ">
                    <ol class="breadcrumb breadcrumb-arrows" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a href="/" target="_self" itemprop="item"><span itemprop="name">Trang chủ</span></a>
                            <meta itemprop="position" content="1">
                        </li>


                        <li class="active" itemprop="itemListElement" itemscope=""
                            itemtype="http://schema.org/ListItem">
                            <span itemprop="item"><span
                                    itemprop="name">{{ $category->name }}</span></span>
                            <meta itemprop="position" content="2">
                        </li>


                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 pull-right collection-content-right">
                    <div class="heading-page text-center">
                        <h1>{{ $category->name }}</h1>
                    </div>
                    <div class="content-product-list ">

                        @foreach($products as $product)
                            <div class="product-loop col-md-3 col-xs-6">


                                <div class="product-block product-resize " data-value="che-khoai-deo-caramen-3">
                                    <div class="product-img" data-link="/products/che-khoai-deo-caramen-3">
                                        <a href="{{route("product.show", $product->slug)}}" title="{{ $product->name }}"
                                           class="image-resize ratiobox lazyloaded" data-expand="-1">
                                            <picture>
                                                <source media="(max-width: 480px)"
                                                        data-srcset="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                        srcset="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                        sizes="221px">
                                                <source media="(min-width: 481px) and (max-width: 767px)"
                                                        data-srcset="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                        srcset="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                        sizes="221px">
                                                <source media="(min-width: 768px)"
                                                        data-srcset="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                        srcset="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                        sizes="221px">
                                                <img class="img-loop lazyautosizes ls-is-cached lazyloaded"
                                                     data-sizes="auto"
                                                     data-src="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                     data-lowsrc="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                     src="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                     alt="{{ $product->name }}">
                                            </picture>
                                        </a>
                                    </div>
                                    <div class="product-detail">
                                        <h3 class="product-name">
                                            <a href="{{route("product.show", $product->slug)}}"
                                               title="Chè khoai dẻo caramen">{{ $product->name }}</a>
                                        </h3>
                                        <div class="product-action">
                                            <div class="box-product-prices">
                                                <div class="product-price">
                                                    <span>{{ number_format($product->price) }}₫</span>

                                                </div>
                                            </div>
                                            <div class="button-add">
                                                <button type="submit" data-product_id="{{ $product->id }}"
                                                        class="action pro-btn-order" data-link="{{ route("product.show", $product->slug) }}">
                                                    Đặt món
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        @endforeach


                    </div>
                    <div class="sortpagibar pagi clearfix text-center">
                        <div id="pagination" class="clearfix">

                            {{ $products->links()}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 pull-left collection-sidebar-left">
                    <div class="collection-sidebar-sticky">
                        <div class="sidebar-group sidebar-group-linklist">
                            <ul class="menuList-links">

                                <li class=""><a href="/" title="Trang chủ"><span>Trang chủ</span></a></li>

                                <!-- Hiển thị trực tiếp danh mục món ăn -->
                                @foreach($categories as $cat)
                                    <li class="{{ $cat->children->count() > 0 ? 'has-submenu level0' : '' }}">
                                        <a href="{{route('category.products', $cat->slug)}}" class="{{ $cat->children->count() > 0 ? 'plus-nClick1' : '' }}" title="{{ $cat->name }}">
                                            <span>{{ $cat->name }}</span>
                                            @if($cat->children->count() > 0)
                                                <span class="icon-plus-submenu"></span>
                                            @endif
                                        </a>
                                        @if($cat->children->count() > 0)
                                            <ul class="submenu-links">
                                                @foreach($cat->children as $childCat)
                                                    <li>
                                                        <a href="{{route('category.products', $childCat->slug)}}" title="{{ $childCat->name }}">
                                                            {{ $childCat->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach

                                <!-- Menu tin tức hiển thị danh mục tin tức -->
                                <li class="has-submenu level0">
                                    <a class="plus-nClick1" href="#" title="Tin tức">
                                        <span>Tin tức</span>
                                        <span class="icon-plus-submenu"></span>
                                    </a>
                                    <ul class="submenu-links">
                                        @foreach($newsCategories as $newsCat)
                                            <li>
                                                <a href="{{route('category.news', $newsCat->slug)}}" title="{{ $newsCat->name }}">
                                                    {{ $newsCat->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Xử lý mở/đóng submenu
        $('.has-submenu > a').click(function(e) {
            e.preventDefault();
            $(this).parent().toggleClass('active');
            $(this).parent().find('> .submenu-links').slideToggle(300);
        });
    });
</script>
@endsection


