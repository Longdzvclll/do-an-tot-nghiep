@extends("frontend.layouts.master")
@section('title', $news->title_seo ? $news->title_seo : $news->title.' - LẮC FOODS')
@section('description', $news->description_seo ? $news->description_seo : $news->sapo)
@section("images", asset("images/news/".$news->image))
@section("content")

    <div class="breadcrumb-shop">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd5 blog-breadcrumb ">
                    <ol class="breadcrumb breadcrumb-arrows" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a href="/" target="_self" itemprop="item"><span itemprop="name">Trang chủ</span></a>
                            <meta itemprop="position" content="1">
                        </li>

                        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a href="/tin-tuc" itemprop="item">
                                <span itemprop="name">Tin tức</span>
                            </a>
                            <meta itemprop="position" content="2">
                        </li>
                        <li class="active" itemprop="itemListElement" itemscope=""
                            itemtype="http://schema.org/ListItem">
                            <span itemprop="item"
                                  content=""><span
                                    itemprop="name">{{$news->title}}</span></span>
                            <meta itemprop="position" content="3">
                        </li>

                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class=" wrapper-row pd-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-right">
                    <div class="content-page">
                        <div class="article-content">
                            <div class="box-article-heading clearfix">
                                <h1 class="sb-title-article">{{$news->title}}</h1>
                                <ul class="article-info-more">
                                    <li>
                                        <time pubdate="" datetime="{{ $news->created_at->format('d') }}">{{ $news->created_at->format('d') }} Tháng {{ $news->created_at->translatedFormat('F') }}, {{ $news->created_at->format('Y') }}</time>
                                    </li>
                                    <li><i class="fa fa-file"></i><a href="/tin-tuc"> Tin
                                            tức</a></li>

                                </ul>
                            </div>
                            <div class="article-pages">

                                <p><strong
                                        style="font-family: Arial, 'Times New Roman', 'Bitstream Charter', Times, serif;">{{$news->sapo}}</strong></p>
                                <div class="item-content css-content default">
                                    {!! $news->content !!}
                                </div>
                            </div>

                        </div>
                        
                        <!-- Bài viết liên quan -->
                        <div class="related-posts mt-5">
                            <div class="heading-related-posts">
                                <h2>Bài viết liên quan</h2>
                            </div>
                            
                            <div class="news-latest clearfix">
                                <div class="list-news-latest layered">
                                    @php
                                        // Lấy 5 bài viết cùng danh mục
                                        $relatedNews = \App\Models\News::where('news_category_id', $news->news_category_id)
                                            ->where('id', '!=', $news->id)
                                            ->inRandomOrder()
                                            ->take(5)
                                            ->get();
                                        
                                        // Nếu không đủ 5 bài, lấy thêm bài mới nhất khác
                                        if ($relatedNews->count() < 5) {
                                            $moreNews = \App\Models\News::where('id', '!=', $news->id)
                                                ->where('news_category_id', '!=', $news->news_category_id)
                                                ->whereNotIn('id', $relatedNews->pluck('id')->toArray())
                                                ->latest()
                                                ->take(5 - $relatedNews->count())
                                                ->get();
                                            $relatedNews = $relatedNews->concat($moreNews);
                                        }
                                    @endphp
                                    
                                    @foreach ($relatedNews as $post)
                                        <div class="item-article clearfix abc">
                                            <div class="post-image">
                                                <a href="{{ route('news.detail', $post->slug) }}"><img
                                                        src="{{ asset("images/news/".$post->image) }}"
                                                        alt="{{ $post->title }}"></a>
                                            </div>
                                            <div class="post-content">
                                                <h3>
                                                    <a href="{{ route('news.detail', $post->slug) }}">{{ $post->title }}</a>
                                                </h3>
                                                <span class="date">
                                                    {{ $post->created_at->format('d M, Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pull-left">
                    <div class="sidebar-blog">


                        <div class="news-latest clearfix">
                            <div class="sidebarblog-title title_block">
                                <h2>Bài viết mới nhất<span class="fa fa-angle-down"></span></h2>
                            </div>
                            <div class="list-news-latest layered">

                                @foreach($recentPosts as $post)
                                <div class="item-article clearfix abc">

                                    <div class="post-image">
                                        <a href="{{ route('news.detail', $post->slug) }}"><img
                                                src="{{ asset("images/news/".$post->image) }}"
                                                alt="{{ $post->title }}"></a>
                                    </div>

                                    <div class="post-content">
                                        <h3>
                                            <a href="{{ route('news.detail', $post->slug) }}">{{ $post->title }}</a>
                                        </h3>

                                        <span class="date">
										{{ $post->created_at->format('d M, Y') }}
										</span>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
