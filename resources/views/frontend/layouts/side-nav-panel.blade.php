<div id="side-nav-panel" class="">
    <a href="#" class="side-nav-panel-close"><i class="fas fa-times"></i></a>
    <div class="menu-wrap">
        <ul id="menu-danh-muc-san-pham-1" class="mobile-menu accordion-menu">
            @foreach($categories as $category)
                <li id="accordion-menu-item-{{$category->id}}"
                    class="menu-item menu-item-type-taxonomy menu-item-object-product_cat"><a
                        href="{{route('category.products', $category->slug)}}"><i
                            class="{{ $category->icon }}"></i>{{ $category->name }}</a>
                </li>
            @endforeach

            <li id="accordion-menu-item-4674"
                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children has-sub">
                <a href="#"><i class="fa fa-bookmark"></i>SP KHÁC</a>
                <span class="arrow"></span>
                <ul class="sub-menu">
                    @foreach($otherCategories as $category)
                        <li id="accordion-menu-item-{{$category->id}}"
                            class="menu-item menu-item-type-taxonomy menu-item-object-product_cat">
                            <a href="{{route('category.products', $category->slug)}}" title="{{ $category->name }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>

        </ul>
    </div>
    <div class="menu-wrap">
        <ul id="menu-top-menu-1" class="top-links accordion-menu">
            <li id="accordion-menu-item-643"
                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-2 current_page_item active">
                <a href="{{asset("/")}}" class=" current ">Trang Chủ</a></li>
            <li id="accordion-menu-item-644" class="menu-item menu-item-type-post_type menu-item-object-page"><a
                    href="{{route('news.list')}}">Tin tức</a></li>
            <li id="accordion-menu-item-632" class="menu-item menu-item-type-post_type menu-item-object-page"><a
                    href="{{route('products.list')}}">Sản phẩm</a></li>

            <li id="accordion-menu-item-734" class="menu-item menu-item-type-custom menu-item-object-custom"><a
                    href="/lien-he/">Liên hệ</a></li>
        </ul>
    </div>
    <form action="{{ route('search') }}" method="get"
          class="searchform">
        <div class="searchform-fields">
            <span class="text"><input name="s" type="text" value="" placeholder="Tìm kiếm sản phẩm..."
                                      autocomplete="off"/></span>
            <input type="hidden" name="post_type" value="product"/>
            <span class="button-wrap">
							<button class="btn btn-special" title="Search" type="submit"><i
                                    class="fas fa-search"></i></button>
						</span>
        </div>
    </form>
</div>
