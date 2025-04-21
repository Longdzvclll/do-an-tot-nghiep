<div class="sidebar-overlay"></div>
<div class="col-lg-3 sidebar porto-blog-sidebar right-sidebar mobile-sidebar"><!-- main sidebar -->
    <div class="pin-wrapper" style="height: 658.859px;">
        <div data-plugin-sticky=""
             data-plugin-options="{&quot;autoInit&quot;: true, &quot;minWidth&quot;: 992, &quot;containerSelector&quot;: &quot;.main-content-wrap&quot;,&quot;autoFit&quot;:true, &quot;paddingOffsetBottom&quot;: 10}"
             style="border-bottom: 0px none rgb(0, 0, 0); width: 236px;" class="">
            <div class="sidebar-toggle"><i class="fa"></i></div>
            <div class="sidebar-content">
                <aside id="categories-2" class="widget widget_categories">
                    <h3 class="widget-title">Chuyên mục</h3>
                    <ul>
                        @foreach($cateNews as $category)
                            <li class="cat-item">
                                <a href="{{route('category.news', $category->slug)}}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </aside>

                <aside id="recent_posts-widget-2" class="widget widget-recent-posts">
                    <h3 class="widget-title">Bài đăng gần đây</h3>
                    <div>
                        @foreach($recentPosts as $post)
                            <div class="post-item-small">
                                <div class="post-image img-thumbnail">
                                    <a href="{{ route('news.detail', $post->slug) }}">
                                        <img width="85" height="85" src="{{ asset("images/news/".$post->image) }}" alt="{{ $post->title }}">
                                    </a>
                                </div>
                                <div class="post-item-content">
                                    <h5 class="post-item-title">
                                        <a href="{{ route('news.detail', $post->slug) }}">{{ $post->title }}</a>
                                    </h5>
                                    <span class="post-date">{{ $post->created_at->format('d M, Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </aside>
            </div>

        </div>
    </div>

</div>
