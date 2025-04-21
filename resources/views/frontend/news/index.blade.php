@extends("frontend.layouts.master")
@section('title', 'Tin tức - LẮC FOODS')
@section('description', 'Cập nhật tin tức mới nhất về ẩm thực, công thức nấu ăn và các món ăn ngon tại LẮC FOODS')
@section("images", asset("images/logo.png"))

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
                            <span itemprop="item" content="{{route("news.list")}}"><span itemprop="name">Tin tức</span></span>
                            <meta itemprop="position" content="2">
                        </li>

                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper-row pd-page">
        <div class="container-fluid">
            <div class="heading-page text-center">
                <h1>Tin tức</h1>
            </div>
            <div class="blog-content">
                <div class="list-article-content blog-posts row">
                    @foreach ($news as $item)
                        <article class="blog-loop col-lg-3 col-md-4 col-xs-6 col-sm-6">
                            <div class="blog-post">

                                <a href="{{ route('news.detail', $item->slug) }}"
                                   class="blog-post-thumbnail ratiobox lazyloaded"
                                   title="{{ $item->title }}" rel="nofollow"
                                   data-expand="-1">
                                    <img class=" lazyautosizes ls-is-cached lazyloaded" data-sizes="auto"
                                         data-src="{{ asset("images/news/".$item->image) }}"
                                         data-lowsrc="{{ asset("images/news/".$item->image) }}"
                                         src="{{ asset("images/news/".$item->image) }}"
                                         alt="{{ $item->title }}" sizes="295px">
                                </a>

                                <h3 class="blog-post-title">
                                    <a href="{{ route('news.detail', $item->slug) }}"
                                       title="{{ $item->title }}">{{ $item->title }}</a>
                                </h3>
                                <div class="blog-post-meta">

                                    <span class="date">
									<time  datetime="{{ $item->created_at->format('d F, Y') }}">{{ $item->created_at->format('d F, Y') }}</time>
								</span>
                                </div>
                                <p class="entry-content">{{ Str::limit($item->sapo, 100) }}</p>
                            </div>
                        </article>
                    @endforeach

                </div>
                <div class="clearfix"></div>
                <div id="pagination" class="clearfix">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        {{$news->links()}}

                    </div>

                </div>
                
                <!-- Bài viết liên quan -->
                <div class="related-posts mt-5">
                    <div class="heading-related-posts text-center mb-4">
                        <h2>Bài viết liên quan</h2>
                    </div>
                    <div class="list-related-posts row">
                        @php
                            $relatedNews = \App\Models\News::inRandomOrder()->take(4)->get();
                        @endphp
                        
                        @foreach ($relatedNews as $item)
                            <article class="blog-loop col-lg-3 col-md-4 col-xs-6 col-sm-6">
                                <div class="blog-post">
                                    <a href="{{ route('news.detail', $item->slug) }}"
                                       class="blog-post-thumbnail ratiobox lazyloaded"
                                       title="{{ $item->title }}" rel="nofollow"
                                       data-expand="-1">
                                        <img class="lazyautosizes ls-is-cached lazyloaded" data-sizes="auto"
                                             data-src="{{ asset("images/news/".$item->image) }}"
                                             data-lowsrc="{{ asset("images/news/".$item->image) }}"
                                             src="{{ asset("images/news/".$item->image) }}"
                                             alt="{{ $item->title }}" sizes="295px">
                                    </a>
                                    <h3 class="blog-post-title">
                                        <a href="{{ route('news.detail', $item->slug) }}"
                                           title="{{ $item->title }}">{{ $item->title }}</a>
                                    </h3>
                                    <div class="blog-post-meta">
                                        <span class="date">
                                            <time datetime="{{ $item->created_at->format('d F, Y') }}">{{ $item->created_at->format('d F, Y') }}</time>
                                        </span>
                                    </div>
                                    <p class="entry-content">{{ Str::limit($item->sapo, 100) }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
