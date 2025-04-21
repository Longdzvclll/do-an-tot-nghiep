<header class="mainHeader  mainHeader_temp02  ">


    <div class="mainHeader-middle">
        <div class="container-fluid">
            <div class="flex-container-header">
                <div class="header-wrap-iconav header-wrap-action">
                    <div class="header-action">
                        <div class="header-action-item header-action_menu">
                            <div class="header-action_text">
                                <a class="header-action__link header-action_clicked" href="javascript:void(0)"
                                   id="site-menu-handle" aria-label="Menu" title="Menu">
										<span class="box-icon">
											<span class="hamburger-menu" aria-hidden="true">
												<span class="bar"></span>
											</span>
											<span class="box-icon--close">
												<svg viewBox="0 0 19 19" role="presentation"><path
                                                        d="M9.1923882 8.39339828l7.7781745-7.7781746 1.4142136 1.41421357-7.7781746 7.77817459 7.7781746 7.77817456L16.9705627 19l-7.7781745-7.7781746L1.41421356 19 0 17.5857864l7.7781746-7.77817456L0 2.02943725 1.41421356.61522369 9.1923882 8.39339828z"
                                                        fill-rule="evenodd"></path></svg>
											</span>
										</span>
                                </a>
                            </div>
                            <div class="header-action_dropdown">
									<span class="box-triangle">
										<svg viewBox="0 0 20 9" role="presentation">
											<path
                                                d="M.47108938 9c.2694725-.26871321.57077721-.56867841.90388257-.89986354C3.12384116 6.36134886 5.74788116 3.76338565 9.2467995.30653888c.4145057-.4095171 1.0844277-.40860098 1.4977971.00205122L19.4935156 9H.47108938z"
                                                fill="#ffffff"></path>
										</svg>
									</span>
                                <div class="header-dropdown_content">
                                    <div class="site-menu menu-mobile" id="siteNav-menu">
                                        <div class="menu-mobile--wrap">
                                            <div class="menu-mobile--bottom">
                                                <nav id="mp-menu" class="mp-menu mp-cover">
                                                    <div class="mp-level" data-level="1">
                                                        <div class="mplus-menu">
                                                            <ul class="mm-panel vertical-menu-list list-root">
                                                                <li class="active">
                                                                    <a class="parent" href="/">Trang chủ</a>
                                                                </li>
                                                                
                                                                <!-- Hiển thị danh mục sản phẩm ở menu mobile -->
                                                                @foreach($categories as $category)
                                                                    @if($category->children->count() > 0)
                                                                        <li class="" data-menu-root="category-{{ $category->id }}">
                                                                            <a class="parent" href="{{ route('category.products', $category->slug) }}">
                                                                                {{ $category->name }}
                                                                                <i>
                                                                                    <svg class="icon icon--arrow-right"
                                                                                         viewBox="0 0 8 12"
                                                                                         role="presentation">
                                                                                        <path stroke="currentColor"
                                                                                              stroke-width="2"
                                                                                              d="M2 2l4 4-4 4"
                                                                                              fill="none"
                                                                                              stroke-linecap="square"></path>
                                                                                    </svg>
                                                                                </i>
                                                                            </a>
                                                                        </li>
                                                                    @else
                                                                        <li class="">
                                                                            <a class="parent" href="{{ route('category.products', $category->slug) }}">
                                                                                {{ $category->name }}
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach

                                                                <li class="">
                                                                    <a class="parent" href="/tin-tuc">Tin tức</a>
                                                                </li>
                                                                <li class="" data-menu-root="102904764">
                                                                    <a class="parent" href="#">Danh mục tin tức
                                                                        <i>
                                                                            <svg class="icon icon--arrow-right"
                                                                                 viewBox="0 0 8 12"
                                                                                 role="presentation">
                                                                                <path stroke="currentColor"
                                                                                      stroke-width="2"
                                                                                      d="M2 2l4 4-4 4"
                                                                                      fill="none"
                                                                                      stroke-linecap="square"></path>
                                                                            </svg>
                                                                        </i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <ul class="mm-panel list-child" id="102904764">
                                                                <li><a href="javascript:;"><i
                                                                            class="fa fa-angle-left"
                                                                            aria-hidden="true"></i>Quay về</a>
                                                                </li>
                                                                <li><a href="{{ route('news.list') }}"><b>Xem tất cả
                                                                            "Tin tức"</b></a></li>
                                                                @foreach($newsCategories as $category)
                                                                <li class="">
                                                                    <a href="{{route('category.news', $category->slug)}}"><span>-</span>{{ $category->name }}</a>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                            
                                                            <!-- Submenu cho các danh mục sản phẩm có con -->
                                                            @foreach($categories as $category)
                                                                @if($category->children->count() > 0)
                                                                    <ul class="mm-panel list-child" id="category-{{ $category->id }}">
                                                                        <li>
                                                                            <a href="javascript:;">
                                                                                <i class="fa fa-angle-left" aria-hidden="true"></i>Quay về
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{ route('category.products', $category->slug) }}">
                                                                                <b>Xem tất cả "{{ $category->name }}"</b>
                                                                            </a>
                                                                        </li>
                                                                        @foreach($category->children as $childCategory)
                                                                            <li class="">
                                                                                <a href="{{ route('category.products', $childCategory->slug) }}">
                                                                                    <span>-</span>{{ $childCategory->name }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-wrap-logo">
                    <div class="wrap-logo " itemscope="" itemtype="http://schema.org/Organization">


                        <a href="{{asset("/")}}" itemprop="url">
                            <img itemprop="logo"
                                 src="{{asset("images/logo.png")}}"
                                 alt="Chick Garden" class="img-responsive logoimg lazyload"/>
                        </a>
                        <div style="display:none"><a href="{{asset("/")}}" itemprop="url">Lacfoods</a></div>


                    </div>
                </div>
                <div class="header-wrap-menu visible-lg">
                    <nav class="navbar-mainmenu">
                        <ul class="menuList-primary">


                            <li class="active">
                                <a href="/" title="Trang chủ">
                                    Trang chủ
                                </a>
                            </li>
                            <li class="">
                                <a href="/gioi-thieu" title="Giới thiệu">
                                    Giới thiệu
                                </a>
                            </li>


                            <!-- Hiển thị danh mục sản phẩm trực tiếp -->
                            @foreach($categories as $category)
                                <li class="{{ $category->children->count() > 0 ? 'has-submenu' : '' }}">
                                    <a href="{{ route('category.products', $category->slug) }}" 
                                       title="{{ $category->name }}">
                                        {{ $category->name }}
                                        @if($category->children->count() > 0)
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        @endif
                                    </a>
                                    
                                    @if($category->children->count() > 0)
                                        <ul class="menuList-submain">
                                            @foreach($category->children as $childCategory)
                                                <li class="">
                                                    <a href="{{ route('category.products', $childCategory->slug) }}"
                                                       title="{{ $childCategory->name }}">
                                                        {{ $childCategory->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach

                            <li class="has-submenu">
                                <a href="#" title="Tin tức">
                                    Tin tức
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                </a>
                                <ul class="menuList-submain">
                                    @foreach($newsCategories as $category)
                                        <li class="">
                                            <a href="{{route('category.news', $category->slug)}}"
                                               title="{{ $category->name }}">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>



                        </ul>
                    </nav>
                </div>
                <div class="header-wrap-action">
                    <div class="header-action">
                        <div class="header-action-item header-action_cart">
                            <div class="header-action_text">
                                <a class="header-action__link  header-action_clicked" href="javascript:void(0)"
                                   id="site-cart-handle" aria-label="Giỏ hàng" title="Giỏ hàng">
										<span class="box-icon">
											<svg class="svg-ico-cart hidden" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 -13 456.75885 456" width="456pt">
												<path
                                                    d="m150.355469 322.332031c-30.046875 0-54.402344 24.355469-54.402344 54.402344 0 30.042969 24.355469 54.398437 54.402344 54.398437 30.042969 0 54.398437-24.355468 54.398437-54.398437-.03125-30.03125-24.367187-54.371094-54.398437-54.402344zm0 88.800781c-19 0-34.402344-15.402343-34.402344-34.398437 0-19 15.402344-34.402344 34.402344-34.402344 18.996093 0 34.398437 15.402344 34.398437 34.402344 0 18.996094-15.402344 34.398437-34.398437 34.398437zm0 0"></path>
												<path
                                                    d="m446.855469 94.035156h-353.101563l-7.199218-40.300781c-4.4375-24.808594-23.882813-44.214844-48.699219-48.601563l-26.101563-4.597656c-5.441406-.96875-10.632812 2.660156-11.601562 8.097656-.964844 5.441407 2.660156 10.632813 8.101562 11.601563l26.199219 4.597656c16.53125 2.929688 29.472656 15.871094 32.402344 32.402344l35.398437 199.699219c4.179688 23.894531 24.941406 41.324218 49.199219 41.300781h210c22.0625.066406 41.546875-14.375 47.902344-35.5l47-155.800781c.871093-3.039063.320312-6.3125-1.5-8.898438-1.902344-2.503906-4.859375-3.980468-8-4zm-56.601563 162.796875c-3.773437 12.6875-15.464844 21.367188-28.699218 21.300781h-210c-14.566407.039063-27.035157-10.441406-29.5-24.800781l-24.699219-139.398437h336.097656zm0 0"></path>
												<path
                                                    d="m360.355469 322.332031c-30.046875 0-54.402344 24.355469-54.402344 54.402344 0 30.042969 24.355469 54.398437 54.402344 54.398437 30.042969 0 54.398437-24.355468 54.398437-54.398437-.03125-30.03125-24.367187-54.371094-54.398437-54.402344zm0 88.800781c-19 0-34.402344-15.402343-34.402344-34.398437 0-19 15.402344-34.402344 34.402344-34.402344 18.996093 0 34.398437 15.402344 34.398437 34.402344 0 18.996094-15.402344 34.398437-34.398437 34.398437zm0 0"></path>
											</svg>
											<span class="box-icon--close">
												<svg viewBox="0 0 19 19" role="presentation"><path
                                                        d="M9.1923882 8.39339828l7.7781745-7.7781746 1.4142136 1.41421357-7.7781746 7.77817459 7.7781746 7.77817456L16.9705627 19l-7.7781745-7.7781746L1.41421356 19 0 17.5857864l7.7781746-7.77817456L0 2.02943725 1.41421356.61522369 9.1923882 8.39339828z"
                                                        fill-rule="evenodd"></path></svg>
											</span>
											<span class="count-holder">
												<span class="count">{{$cartItemsCount}}</span>
											</span>
										</span>
                                    <svg class="svg-icon-ship" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" height="30px" width="30px"
                                         fill="#000000" version="1.1" x="0px" y="0px" viewBox="0 0 100 100"
                                         style="enable-background:new 0 0 100 100;vertical-align: -10px;"
                                         xml:space="preserve"><path
                                            d="M35.3,71.2c-5.7,0-10.3,4.6-10.3,10.3c0,5.7,4.6,10.3,10.3,10.3s10.3-4.6,10.3-10.3C45.6,75.8,41,71.2,35.3,71.2z   M35.3,84.1c-1.4,0-2.6-1.2-2.6-2.6c0-1.4,1.1-2.6,2.6-2.6c1.4,0,2.6,1.2,2.6,2.6C37.9,82.9,36.7,84.1,35.3,84.1z M82.3,71.2  c-5.7,0-10.3,4.6-10.3,10.3c0,5.7,4.6,10.3,10.3,10.3c5.7,0,10.3-4.6,10.3-10.3C92.6,75.8,87.9,71.2,82.3,71.2z M82.3,84.1  c-1.4,0-2.6-1.2-2.6-2.6c0-1.4,1.2-2.6,2.6-2.6c1.4,0,2.6,1.2,2.6,2.6C84.8,82.9,83.7,84.1,82.3,84.1z M34,35H10l0.1,22H34L34,35z   M43.9,19.9c0.5,2.5,2.5,4.6,5.1,5.1c4.2,0.8,7.8-2.4,7.8-6.4c0-0.3,0-0.5,0-0.8h3.9v-1.7h-4.3c-1-2.3-3.3-4-6-4  C46.3,12.1,43.1,15.8,43.9,19.9z M4.5,73.5h8v2h-8V73.5z M1.5,77.5h13v2h-13V77.5z M87.7,66.8c-0.6-0.2-1.2-0.4-1.8-0.6L80.3,59h0  c1,0,1.9-0.3,2.7-0.8v-7.8c-0.8-0.5-1.7-0.8-2.7-0.8c-2.3,0-4.1,1.5-4.7,3.6l-6.5-8.2c-0.5-0.7-1.3-1.1-2.2-0.8  c-0.7,0.2-1.2,0.7-1.4,1.4c-0.3,1.2,0.5,2.2,1.6,2.4L73,61.7L64.1,75H62V51.4c0-1.3-1.1-2.4-2.4-2.4H50l1.4-8.6l1.8,3  c0.2,0.4,0.7,0.6,1.1,0.6h9c0.6-1.5,2-2.5,3.6-2.5c0.4,0,0.9,0.1,1.2,0.2c0-0.1,0-0.2,0-0.3c0-1.7-1.2-3.4-3.5-3.4h-7.3l-3.3-8.9  C53.5,27.8,52.3,27,51,27h-4.1c-1.3,0-2.6,0.9-2.9,2.2l-6.1,20.1c-1.3,4.1,1.7,7.7,6.4,7.7H55v18h-3l0-15H18.8  c-4.2,0-5.9,4.4-4.3,7.5L22.4,82h0.4c0-0.2,0-0.4,0-0.5c0-7,5.6-12.6,12.6-12.6s12.6,5.6,12.6,12.6c0,0.5,0,1-0.1,1.5h21.6  c-0.1-0.6,0-0.6,0-1.3c-0.1-4.9,2.8-9.5,7.3-11.6c7.9-3.7,15.6,1.2,17.7,7.9l0.9-0.3l1-0.3l0,0l1-0.3C95.6,72.2,92.2,68.5,87.7,66.8  z"></path></svg>
                                </a>
                            </div>
                            <div class="header-action_dropdown">
								<span class="box-triangle">
									<svg viewBox="0 0 20 9" role="presentation">
										<path
                                            d="M.47108938 9c.2694725-.26871321.57077721-.56867841.90388257-.89986354C3.12384116 6.36134886 5.74788116 3.76338565 9.2467995.30653888c.4145057-.4095171 1.0844277-.40860098 1.4977971.00205122L19.4935156 9H.47108938z"
                                            fill="#ffffff"></path>
									</svg>
								</span>
                                <div class="header-dropdown_content">
                                    <div class="site-cart">
                                        <div class="cart-ttbold"><p class="ttbold">Giỏ hàng</p></div>
                                        <div class="cart-view clearfix">
                                            <div class="cart-view-scroll">
                                                <table id="clone-item-cart" class="table-clone-cart">
                                                    <tr class="item_2 hidden">
                                                        <td class="img"><a href="" title=""><img src="" alt=""/></a>
                                                        </td>
                                                        <td>
                                                            <p class="pro-title">
                                                                <a class="pro-title-view" href="" title=""></a>
                                                                <span class="variant"></span>
                                                            </p>
                                                            <div class="mini-cart_quantity">
                                                                <div class="pro-quantity-view"><span
                                                                        class="qty-value"></span></div>
                                                                <div class="pro-price-view"></div>
                                                            </div>
                                                            <div class="remove_link remove-cart"></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table id="cart-view">
                                                    @if($cartItemsCount > 0)
                                                        @foreach($cartItems as $item)
                                                            <tr class="item_2 ">
                                                                <td class="img">
                                                                    <a href="{{ route('product.show', $item->id) }}">
                                                                        <img
                                                                            src="{{ asset('images/products/' . $item->attributes->image) }}"
                                                                            alt="{{ $item->name }}">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <p class="pro-title">
                                                                        <a class="pro-title-view"
                                                                           href="{{ route('product.show', $item->id) }}"
                                                                           title="{{ $item->name }}">{{ $item->name }}</a>
                                                                    </p>
                                                                    <div class="mini-cart_quantity">
                                                                        <div class="pro-quantity-view">
                                                                            <span class="qty-value">{{ $item->quantity }}</span>
                                                                        </div>
                                                                        <div class="pro-price-view">{{ number_format($item->price, 0, ',', '.') }}₫</div>
                                                                    </div>
                                                                    <div class="remove_link remove-cart">
                                                                        <a href="javascript:void(0);"
                                                                           onclick="removeItem({{ $item->id }})">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                 x="0px" y="0px" viewBox="0 0 1000 1000"
                                                                                 enable-background="new 0 0 1000 1000"
                                                                                 xml:space="preserve"> <g>
                                                                                    <path
                                                                                        d="M500,442.7L79.3,22.6C63.4,6.7,37.7,6.7,21.9,22.5C6.1,38.3,6.1,64,22,79.9L442.6,500L22,920.1C6,936,6.1,961.6,21.9,977.5c15.8,15.8,41.6,15.8,57.4-0.1L500,557.3l420.7,420.1c16,15.9,41.6,15.9,57.4,0.1c15.8-15.8,15.8-41.5-0.1-57.4L557.4,500L978,79.9c16-15.9,15.9-41.5,0.1-57.4c-15.8-15.8-41.6-15.8-57.4,0.1L500,442.7L500,442.7z"></path>
                                                                                </g> </svg>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr class="item-cart_empty">
                                                            <td>
                                                                <div class="svgico-mini-cart">
                                                                    <svg width="81" height="70" viewBox="0 0 81 70">
                                                                        <g transform="translate(0 2)"
                                                                           stroke-width="4" stroke="#ff0100"
                                                                           fill="none" fill-rule="evenodd">
                                                                            <circle stroke-linecap="square" cx="34"
                                                                                    cy="60" r="6"></circle>
                                                                            <circle stroke-linecap="square" cx="67"
                                                                                    cy="60" r="6"></circle>
                                                                            <path
                                                                                d="M22.9360352 15h54.8070373l-4.3391876 30H30.3387146L19.6676025 0H.99560547"></path>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                                Hiện chưa có sản phẩm
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </table>
                                            </div>
                                            <div class="line"></div>
                                            <div class="cart-view-total">
                                                <table class="table-total">
                                                    <tr>
                                                        <td class="text-left">TỔNG TIỀN:</td>
                                                        <td class="text-right"
                                                            id="total-view-cart">{{ number_format(\Cart::getTotal() ) }}
                                                            ₫
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="{{route("cart.view")}}"
                                                               class="linktocart button">Xem giỏ hàng</a></td>
                                                        <td><a href="/thanh-toan" class="linktocheckout button">Thanh
                                                                toán</a></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
