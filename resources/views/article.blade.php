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
                                <i class="ico-tag"></i> <a href="{{ route('blog.post_by_category',[$post->category->id,str_replace(' ','-',strtolower($post->category->category))]) }}">{{ $post->category->category }}</a>
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
            <div class="author-img"><img alt="" src="{{ asset('/profile_pic/'.$post->user->profile_pic) }}"></div>
            <div class="author-content">
                <h4>{{$post->user->name}}</h4>
                <p>{{$post->user->bio}}</p>
            </div>
        </div>
    </article><!-- Blog Article End -->
    <!-- Blog Article Start -->
    <article>
        <!-- Start Comment Area -->
        <div id="comments">
            <?php
                $count = $post->comments->count();
                $reply_count = 0;
                foreach($post->comments as $comment){
                    $reply_count = $reply_count + $comment->reply->count();
                }
                $count = $count + $reply_count;
            ?>
            <h3>{{$count}} comments</h3>
            <ol class="comments-list">
                @foreach($post->comments as $comment)
                    <li>
                        <div class="comment-box clearfix">
                            <div class="avatar">
                                <a href="#"><img alt="" src="{{ asset('/profile_pic/profile_pic.png') }}"></a>
                            </div>
                            <div class="comment-content">
                                <div class="comment-meta">
                                    <h4 class="comment-by"><a href="#">{{ $comment->author }}</a></h4>
                                    <span>{{ $comment->email }} - {{ date('F j, Y ',strtotime($comment->created_at)) }}</span>
                                </div>
                                <p>{{ $comment->comments }}</p>
                                <?php
                                    $comment_id = $comment->id;
                                    echo '<a class="reply-link" href="#respond" onclick="Reply('.$comment_id.')">Reply</a>'
                                ?>
                            </div>
                            @if($comment->reply)
                                <ul>
                                @foreach($comment->reply as $reply)
                                        <li>
                                            <div class="comment-box clearfix">
                                                <div class="avatar">
                                                    <a href="#"><img alt="" src="{{ asset('/profile_pic/profile_pic.png') }}"></a>
                                                </div>
                                                <div class="comment-content">
                                                    <div class="comment-meta">
                                                        <h4 class="comment-by"><a href="#">{{$reply->author}}</a></h4>
                                                        <span>{{ $reply->email }} - {{ date('F j, Y ',strtotime($reply->created_at)) }}</span>
                                                    </div>
                                                    <p>{{ $reply->reply }}</p>
                                                    <?php
                                                    $comment_id = $comment->id;
                                                        echo '<a class="reply-link" href="#respond" onclick="Reply('.$comment_id.')">Reply</a>'
                                                    ?>
                                                </div>
                                            </div>
                                        </li>
                                @endforeach
                                </ul>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ol>
        </div><!-- End Comment Area -->
    </article><!-- Blog Article End -->
    <script>
        function Reply($comment_id) {
            $('#comment_id').val($comment_id);
            document.getElementById("author").focus();
        }
    </script>
    <!-- Blog Article Start -->
    <article>
        <!-- Start Respond Form -->
        <div id="respond">
            <h2 class="respond-title">Add Comment</h2>
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('blog.comment',$post->id) }}" method="post" role="form">
                @csrf
                <input type="hidden" id="comment_id" name="comment_id" value="">
                <div class="row">
                    <div class="col-md-6">
                        <input class="form-control" id="author" name="author" placeholder="Name" type="text" value="{{old('author')}}">
                        @if($errors->has('author'))
                            <label class="text-danger">{{ $errors->first('author') }}</label>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" name="email" placeholder="Email" type="email" value="{{old('email')}}">
                        @if($errors->has('email'))
                            <label class="text-danger">{{ $errors->first('email') }}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <textarea class="form-control" cols="45" name="comment" placeholder="Comment" rows="8"></textarea>
                        @if($errors->has('email'))
                            <label class="text-danger">{{ $errors->first('comment') }}</label>
                        @endif
                        <br>
                        <button class="btn btn-danger btn-more" type="submit"><i class="fa fa-check"></i> Comment</button>
                    </div>
                </div>
            </form>
        </div><!-- End Respond Form -->
    </article><!-- Blog Article End -->
    <!-- Blog Article Start -->
    <article>
        <div class="relate-post">
            <h4>Related Post</h4>
            <div class="row">
                @foreach($related_posts as $post)
                    <div class="col-sm-4">
                        <ul class="posts-list">
                            <li>
                                <div class="widget-thumb">
                                    <a href="#"><img alt="" src="{{ asset('/post_media/'.$post->postMedia[0]->media)  }}"></a>
                                </div>
                                <br>
                                <div class="widget-content">
                                    <a href="{{ route('blog.single_blog',$post->post_url) }}">{{ $post->post_title }}</a>

                                    <div class="meta">
                                        <span><i class="ico-calendar-alt-fill"></i>{{ date('F j, Y ',strtotime($post->created_at)) }}</span>
                                        <span><i class="ico-tag"></i>{{ $post->category->category }}</span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                        </ul>
                    </div>

                @endforeach

            </div>
        </div>
    </article><!-- Blog Article End -->

@endsection

