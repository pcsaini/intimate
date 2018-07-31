@extends('layouts.master')

@section('page_title','Intimate Blog - Home')

@section('hero')

    <section class="text-center" id="hero-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="intro-area">
                        <h2 class="page-title">{{$post->post_title}}</h2>
                        <div class="entry-meta">
                            <span class="meta-part">
                                <i class="ico-user"></i> <a href="{{route('blog.post_by_users',[$post->user_id,str_replace(' ','-',strtolower($post->user->name))]) }}">{{ $post->user->name }}</a></span>
                            <span class="meta-part">
                                <i class="ico-calendar-alt-fill"></i> <a href="#">{{ date('F j, Y ',strtotime($post->created_at)) }}</a></span>
                            <span class="meta-part">
                                <i class="ico-comments"></i> <a href="#">20</a></span>
                            <span class="meta-part">
                                <i class="ico-tag"></i> <a href="#">{{ $post->category->category }}</a>
                            </span>
                            <span class="meta-part">
                                <i class="ico-star"></i>
                                <a href="#">7.5</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('content')

    <!-- Blog Article Start-->
    <article class="single-post-content">
        <!-- Blog item Start -->
        <!-- Feature inner Start -->
        <div class="feature-inner">
            <!-- Post post-thumb -->
            <div class="post-thumb">
                <div class="touch-slider owl-carousel">
                    @foreach($post->postMedia as $post_media)
                        <div class="item">
                            <a href="#"><img alt="" src="{{ asset('/post_media/'.$post_media->media)  }}"></a>
                        </div>
                    @endforeach
                </div>
            </div><!-- End Post post-thumb -->
        </div><!-- Feature inner End -->
        <br>
        <?php
        echo $post->post;
        ?>
        <div class="links">
            <a class="heart" href="#"><i class="ico-heart"></i>(143)</a> <a class="twitter" href="#"><i class="ico-twitter-with-circle"></i> Tweet</a>
            <a class="facebook" href="#"><i class=ico-facebook-with-circle"></i> Share</a> <a class="google-plus" href="#"><i class="ico-google-with-circle"></i> Google+</a>
            <a class="linkedin" href="#"><i class="ico-linkedin-with-circle"></i> Linkedin</a>
        </div>
    </article><!-- Blog Article End-->
    <!-- Blog Article Start -->
    <article>
        <div class="author">
            <div class="author-img"><img alt="" src=
                "img/blog/portfolio.jpg"></div>
            <div class="author-content">
                <h4>About Marggaret Gould</h4>
                <p>Margaret Gould Stewart is Director of
                    Product Design at Facebook, Inc, leading the
                    company's user experience efforts around
                    advertising and business presence. Prior to her
                    current role, she spent three years leading UX
                    for YouTube, and two years leading Search and
                    Consumer Products UX at Google.</p><a class=
                                                          "btn btn-common btn-more" href="#">Learn More
                    <i class="ico-arrow-right"></i></a>
            </div>
        </div>
    </article><!-- Blog Article End -->
    <!-- Blog Article Start -->
    <article>
        <!-- Start Comment Area -->
        <div id="comments">
            <ol class="comments-list">
                <li>
                    <div class="comment-box clearfix">
                        <div class="avatar">
                            <a href="#"><img alt="" src=
                                "img/blog/user1.jpg"></a>
                        </div>
                        <div class="comment-content">
                            <div class="comment-meta">
                                <h4 class="comment-by"><a href=
                                                          "#">Anna Ostyankoa</a></h4>
                            </div>
                            <p>Lorem ipsum dolor sit amet,
                                consectetur adipisicing elit, sed
                                do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut
                                enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi
                                ut aliquip ex ea commodo
                                consequat.</p><a class="reply-link"
                                                 href="#">Reply</a>
                        </div>
                    </div>
                </li>
                <li>
                    <ul>
                        <li>
                            <div class="comment-box clearfix">
                                <div class="avatar">
                                    <a href="#"><img alt=""
                                                     src="img/blog/user2.jpg"></a>
                                </div>
                                <div class="comment-content">
                                    <div class="comment-meta">
                                        <h4 class="comment-by">
                                            <a href="#">Anna
                                                Ostyankoa</a></h4>
                                    </div>
                                    <p>Lorem ipsum dolor sit
                                        amet, consectetur
                                        adipisicing elit, sed do
                                        eiusmod tempor incididunt
                                        ut labore et dolore magna
                                        aliqua. Ut enim ad minim
                                        veniam, quis nostrud
                                        exercitation ullamco
                                        laboris nisi ut aliquip ex
                                        ea commodo
                                        consequat.</p><a class=
                                                         "reply-link" href=
                                                         "#">Reply</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-box clearfix">
                                <div class="avatar">
                                    <a href="#"><img alt=""
                                                     src="img/blog/user2.jpg"></a>
                                </div>
                                <div class="comment-content">
                                    <div class="comment-meta">
                                        <h4 class="comment-by">
                                            <a href="#">Anna
                                                Ostyankoa</a></h4>
                                    </div>
                                    <p>Lorem ipsum dolor sit
                                        amet, consectetur
                                        adipisicing elit, sed do
                                        eiusmod tempor incididunt
                                        ut labore et dolore magna
                                        aliqua. Ut enim ad minim
                                        veniam, quis nostrud
                                        exercitation ullamco
                                        laboris nisi ut aliquip ex
                                        ea commodo
                                        consequat.</p><a class=
                                                         "reply-link" href=
                                                         "#">Reply</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <div class="comment-box clearfix">
                        <div class="avatar">
                            <a href="#"><img alt="" src=
                                "img/blog/user4.jpg"></a>
                        </div>
                        <div class="comment-content">
                            <div class="comment-meta">
                                <h4 class="comment-by"><a href=
                                                          "#">Anna Ostyankoa</a></h4>
                            </div>
                            <p>Lorem ipsum dolor sit amet,
                                consectetur adipisicing elit, sed
                                do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut
                                enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi
                                ut aliquip ex ea commodo
                                consequat.</p><a class="reply-link"
                                                 href="#">Reply</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="comment-box clearfix">
                        <div class="avatar">
                            <a href="#"><img alt="" src=
                                "img/blog/user4.jpg"></a>
                        </div>
                        <div class="comment-content">
                            <div class="comment-meta">
                                <h4 class="comment-by"><a href=
                                                          "#">Anna Ostyankoa</a></h4>
                            </div>
                            <p>Lorem ipsum dolor sit amet,
                                consectetur adipisicing elit, sed
                                do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut
                                enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi
                                ut aliquip ex ea commodo
                                consequat.</p><a class="reply-link"
                                                 href="#">Reply</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="comment-box clearfix">
                        <div class="avatar">
                            <a href="#"><img alt="" src=
                                "img/blog/user4.jpg"></a>
                        </div>
                        <div class="comment-content">
                            <div class="comment-meta">
                                <h4 class="comment-by"><a href=
                                                          "#">Anna Ostyankoa</a></h4>
                            </div>
                            <p>Lorem ipsum dolor sit amet,
                                consectetur adipisicing elit, sed
                                do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut
                                enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi
                                ut aliquip ex ea commodo
                                consequat.</p><a class="reply-link"
                                                 href="#">Reply</a>
                        </div>
                    </div>
                </li>
            </ol>
        </div><!-- End Comment Area -->
    </article><!-- Blog Article End -->
    <!-- Blog Article Start -->
    <article>
        <!-- Start Respond Form -->
        <div id="respond">
            <h2 class="respond-title">Add Comment</h2>
            <form action="#">
                <div class="row">
                    <div class="col-md-6">
                        <input class="form-control" id="author"
                               name="author" placeholder="Name" size=
                               "30" type="text" value="">
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" id="email"
                               name="author" placeholder="Email" size=
                               "30" type="text" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                                        <textarea class="form-control" cols=
                                        "45" id="comment" name="comment"
                                                  placeholder="Comment" rows="8">
</textarea> <a class="btn btn-common btn-more"
               id="submit" type="submit"><i class=
                                            "fa fa-check"></i> Submit Comment</a>
                    </div>
                </div>
            </form>
        </div><!-- End Respond Form -->
    </article><!-- Blog Article End -->
    <!-- Blog Article Start -->
    <article>
        <div class="relate-post">
            <h4>Releate Post</h4>
            <div class="row">
                <div class="col-sm-6">
                    <ul class="posts-list">
                        <li>
                            <div class="widget-thumb">
                                <a href="#"><img alt="" src=
                                    "img/post/post1.jpg"></a>
                            </div>
                            <div class="widget-content">
                                <a href="#">Aladdin rides
                                    'magic carpet' at New York in
                                    Halloween prank</a>
                                <div class="meta">
                                                    <span><i class=
                                                             "ico-calendar-alt-fill"></i>
                                                    October 7,2015</span>
                                    <span><i class=
                                             "ico-tag"></i>
                                                    Technology</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="posts-list">
                        <li>
                            <div class="widget-thumb">
                                <a href="#"><img alt="" src=
                                    "img/post/post2.jpg"></a>
                            </div>
                            <div class="widget-content">
                                <a href="#">New Zealand makes
                                    history by winning third Rugby
                                    WC</a>
                                <div class="meta">
                                                    <span><i class=
                                                             "ico-calendar-alt-fill"></i>
                                                    October 7,2015</span>
                                    <span><i class=
                                             "ico-tag"></i>
                                                    Technology</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="posts-list">
                        <li>
                            <div class="widget-thumb">
                                <a href="#"><img alt="" src=
                                    "img/post/post3.jpg"></a>
                            </div>
                            <div class="widget-content">
                                <a href="#">Romania calls for 3
                                    days of mourning after
                                    nightclub fire kills at least
                                    27</a>
                                <div class="meta">
                                                    <span><i class=
                                                             "ico-calendar-alt-fill"></i>
                                                    October 7,2015</span>
                                    <span><i class=
                                             "ico-tag"></i>
                                                    Technology</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="posts-list">
                        <li>
                            <div class="widget-thumb">
                                <a href="#"><img alt="" src=
                                    "img/post/post4.jpg"></a>
                            </div>
                            <div class="widget-content">
                                <a href="#">3 years of 'Star
                                    Wars Episode VII' fandom,
                                    celebrated</a>
                                <div class="meta">
                                                    <span><i class=
                                                             "ico-calendar-alt-fill"></i>
                                                    October 7,2015</span>
                                    <span><i class=
                                             "ico-tag"></i>
                                                    Technology</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </article><!-- Blog Article End -->

@endsection

