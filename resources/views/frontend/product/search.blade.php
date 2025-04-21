@extends("frontend.layouts.master")
@section('title', 'Bạn đã tìm kiếm từ khóa ' .$searchTerm. ' - LẮC FOODS')
@section('description', 'Bạn đã tìm kiếm từ khóa ' .$searchTerm. ' - LẮC FOODS')
@section("images", asset("images/logo.png"))
@section("content")
    <div class="searchPage" id="layout-search">
        <div class="container-fluid">
            <div class="row pd-page">
                <div class="col-md-12 col-xs-12">
                    <div class="heading-page">
                        <h1>Tìm kiếm</h1>
                        <p class="subtxt">Có <span>{{$products->count()}} sản phẩm</span> cho tìm kiếm</p>
                    </div>
                    <div class="wrapbox-content-page">


                        <div class="content-page" id="search">

                            <div class="results">
                                <div class=" search-list-results content-product-list">
                                    @foreach($products as $product)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 product-loop">

                                        <div class="product-block product-resize " data-value="tra-dau-moc-chau">
                                            <div class="product-img" data-link="/products/tra-dau-moc-chau">
                                                <a href="{{route("product.show", $product->slug)}}" title="{{ $product->name }}"
                                                   class="image-resize ratiobox lazyloaded" data-expand="-1">
                                                    <picture>
                                                        <source media="(max-width: 480px)"
                                                                data-srcset="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                                srcset="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                                sizes="303px">
                                                        <source media="(min-width: 481px) and (max-width: 767px)"
                                                                data-srcset={{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                                srcset="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                                sizes="303px">
                                                        <source media="(min-width: 768px)"
                                                                data-srcset="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                                srcset="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                                sizes="303px">
                                                        <img class="img-loop lazyautosizes lazyloaded" data-sizes="auto"
                                                             data-src="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                             data-lowsrc="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                             src="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                                             alt="{{ $product->name }}" sizes="303px">
                                                    </picture>
                                                </a>
                                            </div>
                                            <div class="product-detail">
                                                <h3 class="product-name">
                                                    <a href="{{route("product.show", $product->slug)}}" title="{{ $product->name }}">{{ $product->name }}</a>
                                                </h3>
                                                <div class="product-action">
                                                    <div class="box-product-prices">
                                                        <div class="product-price">
                                                            <span>{{ number_format($product->price) }}₫</span>

                                                        </div>
                                                    </div>
                                                    <div class="button-add">

                                                        <button type="submit" class="action pro-btn-order"
                                                                data-link="{{route("product.show", $product->slug)}}">Đặt món
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    @endforeach


                                </div>
                            </div>
                            <div class="sortpagibar pagi clearfix text-center">
                                <div id="pagination" class="clearfix">
                                    {{ $products->appends(['orderby' => request('orderby')])->links() }}

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

