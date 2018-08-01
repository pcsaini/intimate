<div class="sidebar">
    <div class="entry-widget">
        <div class="widget-profile">
            <div class="image"><img alt="" src="{{ asset('Blog/img/cover.jpg') }}"></div>
            <div class="portfolio"><img alt="" src="{{ asset('Blog/img/portfolio.jpg') }}"></div>
            <div class="info">
                <h3 class="name">Margaret Gould</h3>
                <p class="details">Margaret Gould Stewart
                    currently serves as Director of Product
                    Design at Facebook. She previously served
                    as Director of User Experience at YouTube.
                    Prior to that, she spent two years leading
                    Search and Consumer Products UX at Google.
                    Margaret has been a leading practitioner
                    and manager in the field of User Experience
                    for over 15 years.</p>
                <div class="social-links">
                    <a class="twitter social-link" data-placement="top" data-toggle="tooltip" href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                    <a class="facebook social-link" data-placement="top" data-toggle="tooltip" href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                    <a class="google-plus social-link" data-placement="top" data-toggle="tooltip" href="#" title="Google+"><i class="fa fa-google-plus"></i></a>
                    <a class="linkedin social-link" data-placement="top" data-toggle="tooltip" href="#" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                    <a class="dribbble social-link" data-placement="top" data-toggle="tooltip" href="#" title="Dribbble"><i class="fa fa-dribbble"></i></a>
                    <a class="pinterest social-link" data-placement="top" data-toggle="tooltip" href="#" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="entry-widget">
        <h5 class="widget-title">Category</h5>
        <ul class="archivee">
            @foreach($category as $cat)
                <li>
                    <a href="{{ route('blog.post_by_category',[$cat->id,str_replace(' ','-',strtolower($cat->category))]) }}"><i class="ico-keyboard_arrow_right"></i> {{ $cat->category }}</a>
                </li>
            @endforeach

        </ul>
    </div>

    <div class="entry-widget">
        <h5 class="widget-title">Archive</h5>
        <ul class="archivee">
            @foreach($archives as $archive)
                <li>
                    <a href="{{ route('blog.post_by_archives',[$archive->month,$archive->year]) }}"><i class="ico-keyboard_arrow_right"></i> {{ $archive->month }}, {{  $archive->year  }} ({{  $archive->count  }})</a>
                </li>
            @endforeach

        </ul>
    </div>

    <div class="entry-widget">
        <!-- Nav Tabs -->
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href=
                "#tab1">Recent</a>
            </li>
            <li>
                <a data-toggle="tab" href=
                "#tab2">Popular</a>
            </li>
            <li>
                <a data-toggle="tab" href=
                "#tab3">Comments</a>
            </li>
        </ul><!-- Tab Panels -->
        <div class="tab-content">
            <!-- Tab Content 1 -->
            <div class="tab-pane in active fadeInDown" id=
            "tab1">
                <ul class="posts-list">
                    @foreach($latest_posts as $post)
                        <li>
                            <div class="widget-thumb">
                                <a href="{{ route('blog.single_blog',$post->post_url) }}"><img alt="" src="{{ asset('/post_media/'.$post->postMedia[0]->media)  }}"></a>
                            </div>
                            <br>
                            <div class="widget-content">
                                <a href="{{ route('blog.single_blog',$post->post_url) }}">{{ $post->post_title }}</a>
                                <div class="meta">
                                    <span><i class="ico-calendar-alt-fill"></i>
                                        {{ date('F j, Y ',strtotime($post->created_at)) }}
                                    </span>
                                    <span><i class="ico-tag"></i>
                                        {{ $post->category->category }}
                                    </span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    @endforeach
                </ul>
            </div><!-- Tab Content 2 -->
            <div class="tab-pane fadeInDown" id="tab2">
                <ul class="posts-list">
                    @foreach($popular_posts as $post)
                        <li>
                            <div class="widget-thumb">
                                <a href="{{ route('blog.single_blog',$post->post_url) }}"><img alt="" src="{{ asset('/post_media/'.$post->postMedia[0]->media)  }}"></a>
                            </div>
                            <br>
                            <div class="widget-content">
                                <a href="{{ route('blog.single_blog',$post->post_url) }}">{{ $post->post_title }}</a>
                                <div class="meta">
                                    <span><i class="ico-calendar-alt-fill"></i>
                                        {{ date('F j, Y ',strtotime($post->created_at)) }}
                                    </span>
                                    <span><i class="ico-tag"></i>
                                        {{ $post->category->category }}
                                    </span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    @endforeach
                </ul>
            </div><!-- End Tab Content 2 -->
            <!-- Tab Content 3 -->
            <div class="tab-pane" id="tab3">
                <ul class="posts-list">
                    @foreach($comments as $comment)
                        <li>
                            <div class="widget-content">
                                <a href="#">{{ $comment->author }}</a> comments on <a href="{{ route('blog.single_blog',$comment->post->post_url) }}">{{$comment->post->post_title}}</a>
                                <div class="meta">
                                    <span><i class="ico-calendar-alt-fill"></i> {{ date('F j, Y ',strtotime($comment->created_at)) }}</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </li>

                    @endforeach
                </ul>
            </div><!-- End Tab Content 3 -->
            <a class="btn btn-common more" href="#">More
                Stories <i class="ico-arrow-right"></i></a>
        </div><!-- End Tab Panels -->
    </div>

    <div class="entry-widget">
        <h5 class="widget-title">Tags</h5>
        <div class="tag">
            @foreach($tags as $tag)
                <a href="{{route('blog.post_by_tags',[$tag->id,str_replace(' ','-',strtolower($tag->name))]) }}"><span class="{{$tag->class}}">{{ $tag->name }}</span></a>
            @endforeach
        </div>
    </div>

    <div class="entry-widget">
        <h5 class="widget-title">Meta</h5>
        <ul class="meta-list">
            <li>
                <a href="{{ route('get_login') }}"><i class="ico-keyboard_arrow_right"></i> Log In</a>
            </li>
            <li>
                <a href="{{ route('get_register') }}"><i class="ico-keyboard_arrow_right"></i> Register</a>
            </li>

        </ul>
    </div>
</div>