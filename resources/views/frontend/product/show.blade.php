@extends("frontend.layouts.master")
@section('title', $product->name)
@section('description', $product->name)
@section("images", asset('images/products/' . $product->mainImage->image_name))

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
			<span itemprop="item" content="">
				<span itemprop="name">{{ $product->name }}</span>
			</span>
                            <meta itemprop="position" content="3">
                        </li>

                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="product-detail-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row product-detail-main">
                        <div class="col-lg-8 col-12">


                            <div class="product-full-img">
                                <img class="product-image-feature"
                                     src="{{ asset('images/products/' . $product->mainImage->image_name) }}"
                                     alt="{{ $product->name }}">
                            </div>

                            @if($product->content)
                            <div class="product-content mt-4">
                                <div class="title-bl">
                                    <h2>Nội dung chi tiết</h2>
                                </div>
                                <div class="content-detail">
                                    <div class="content-productdetail">
            
                                        {!! $product->content !!}
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="product-content-desc" id="detail-product">
                                <div class="product-title">
                                    <h1>{{ $product->name }}</h1>


                                </div>
                                <div class="product-price" id="price-preview"><span class="pro-price">{{ number_format($product->price) }}₫</span>
                                </div>


                                <form  action="{{ route('cart.add') }}" method="post" class="variants clearfix">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="selector-actions">
                                        <div class="quantity-area clearfix">
                                            <input type="button" value="-" class="qty-btn">
                                            <input type="text" id="quantity" name="quantity" value="1" min="1"
                                                   class="quantity-selector">
                                            <input type="button" value="+" class="qty-btn">
                                        </div>

                                        <div class="wrap-addcart clearfix">
                                            <button type="submit" id="add-to-cart" class=" btn-addtocart btn "
                                                    name="add">
                                                Đặt món
                                            </button>
                                        </div>
                                    </div>
                                    <div class="product-action-bottom hidden visible-sm visible-xs">
                                        <div class="input-bottom">
                                            <input id="quan-input" type="number" value="1" min="1">
                                        </div>
                                        <button type="submit" id="add-to-cartbottom" class=" add-cart-bottom btn"
                                                name="add">
                                            Đặt món
                                        </button>
                                    </div>
                                </form>
                                
                                <div class="product-description">
                                    <div class="title-bl">
                                        <h2>Mô tả</h2>
                                    </div>
                                    <div class="description-content">
                                        <div class="description-productdetail">
                                            {!! $product->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-productRelated clearfix">
                        <div class="heading-title text-center">
                            <h2>Sản phẩm liên quan</h2>
                        </div>
                        <div class="content-product-list">
                            @foreach ($relatedProducts as $relatedProduct)
                                <div class="col-md-3 col-sm-6 product-loop ">
                                    <div class="product-block product-resize " >
                                        <div class="product-img" data-link="/products/tra-dao-nhiet-doi">
                                            <a href="{{ route('product.show', $relatedProduct->slug) }}" title="{{ $relatedProduct->name }}"
                                               class="image-resize ratiobox lazyloaded" data-expand="-1">
                                                <picture>
                                                    <source media="(max-width: 480px)"
                                                            data-srcset="{{ asset('images/products/' . $relatedProduct->mainImage->image_name) }}"
                                                            srcset="{{ asset('images/products/' . $relatedProduct->mainImage->image_name) }}"
                                                            sizes="303px">
                                                    <source media="(min-width: 481px) and (max-width: 767px)"
                                                            data-srcset="{{ asset('images/products/' . $relatedProduct->mainImage->image_name) }}"
                                                            srcset="{{ asset('images/products/' . $relatedProduct->mainImage->image_name) }}"
                                                            sizes="303px">
                                                    <source media="(min-width: 768px)"
                                                            data-srcset="{{ asset('images/products/' . $relatedProduct->mainImage->image_name) }}"
                                                            srcset="{{ asset('images/products/' . $relatedProduct->mainImage->image_name) }}"
                                                            sizes="303px">
                                                    <img class="img-loop lazyautosizes ls-is-cached lazyloaded"
                                                         data-sizes="auto"
                                                         data-src="/{{ asset('images/products/' . $relatedProduct->mainImage->image_name) }}"
                                                         data-lowsrc="{{ asset('images/products/' . $relatedProduct->mainImage->image_name) }}"
                                                         src="{{ asset('images/products/' . $relatedProduct->mainImage->image_name) }}"
                                                         alt=" {{ $relatedProduct->name }}" sizes="303px">
                                                </picture>
                                            </a>
                                        </div>
                                        <div class="product-detail">
                                            <h3 class="product-name">
                                                <a href="{{ route('product.show', $relatedProduct->slug) }}" title="{{ $relatedProduct->name }}">{{ $relatedProduct->name }}</a>
                                            </h3>
                                            <div class="product-action">
                                                <div class="box-product-prices">
                                                    <div class="product-price">
                                                        <span>{{ number_format($relatedProduct->price, 0, ',', '.') }}₫</span>

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

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section("script")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function plusQuantity() {
                let quantityInput = document.getElementById('quantity');
                let currentValue = parseInt(quantityInput.value);

                // Tăng số lượng
                quantityInput.value = currentValue + 1;
            }

            function minusQuantity() {
                let quantityInput = document.getElementById('quantity');
                let currentValue = parseInt(quantityInput.value);

                // Kiểm tra để không cho phép số lượng nhỏ hơn 1
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            }

            document.getElementById('quantity').addEventListener('input', function (e) {
                let value = e.target.value;

                // Chỉ cho phép nhập số, nếu không phải số thì chuyển về giá trị cũ là 1
                if (!/^\d+$/.test(value) || parseInt(value) < 1) {
                    e.target.value = 1;
                }
            });

            // Gắn các hàm sự kiện vào nút bấm sau khi DOM đã sẵn sàng
            document.querySelector('.qty-btn[value="+"]').addEventListener('click', plusQuantity);
            document.querySelector('.qty-btn[value="-"]').addEventListener('click', minusQuantity);
        });

    </script>
@endsection
