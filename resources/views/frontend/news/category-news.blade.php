@extends("frontend.layouts.master")
@section('title', $category->title_seo ? $category->title_seo : $category->name.' - LẮC FOODS')
@section('description', $category->description_seo ? $category->description_seo : $category->name.' - LẮC FOODS')
@section("images", asset("images/logo.png"))
@section("content")
    <section class="page-top page-header-5">
        <div class="container hide-title">
            <div class="row align-items-center">
                <div class="breadcrumbs-wrap col-lg-6">
                <span class="yoast-breadcrumbs"><span><a href="{{asset("/")}}">Home</a></span> » <span
                        class="breadcrumb_last" aria-current="page">{{$category->name}}</span></span></div>
              
            </div>
        </div>
    </section>
    <div id="main" class="column2 column2-right-sidebar boxed"><!-- main -->

        <div class="container">
            <div class="row main-content-wrap">

                <!-- main content -->
                <div class="main-content col-lg-9">


                    <div id="content" role="main">
                        <div class="heading-page text-center">
                            <h1>{{$category->name}}</h1>
                        </div>
                        <div class="blog-content">
                            <div class="list-article-content blog-posts row">
                                @foreach ($newsList as $item)
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
                            <div class="clearfix"></div>
                            <div id="pagination" class="clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    {{$newsList->links()}}
                                </div>
                            </div>
                        </div>
                    </div>



                </div><!-- end main content -->

            @include("frontend.layouts.news-sidebar")
                <!-- end main sidebar -->

            </div>
        </div>
    </div>

@endsection
