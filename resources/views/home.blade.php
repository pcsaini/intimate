@extends('layouts.master')

@section('page_title','Intimate Blog - Home')

@section('hero')

    <section class="text-center" id="hero-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="intro-area">
                        <h3>Welcome To</h3>
                        <h2 class="page-title">Intimate Blog</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('content')

    <article>
        <!-- Blog item Start -->
        <div class="blog-item-wrap">
            <!-- Post Format icon Start -->
            <div class="post-format">
                <span><i class="fa fa-camera"></i></span>
            </div><!-- Post Format icon End -->
            <h2 class="blog-title"><a href="#">Personal Blog and Portfolio Template</a></h2><!-- Entry Meta Start-->
            <div class="entry-meta">
                <span class="meta-part"><i class="ico-user"></i> <a href="#">JamesMaclern</a></span>
                <span class="meta-part"><i class="ico-calendar-alt-fill"></i> <a href="#">January 7, 2015</a></span>
                <span class="meta-part"><i class="ico-comments"></i>
                    <a href="#">20</a></span> <span class="meta-part"><i class="ico-tag"></i> <a href="#">Tech</a></span>
                <span class="meta-part"><i class="ico-star"></i> <a href="#">7.5</a></span>
            </div><!-- Entry Meta End-->
            <!-- Feature inner Start -->
            <div class="feature-inner">
                <a data-lightbox="roadtrip" href=""><img alt="" src="{{ asset('Blog/img/blog/blog-01.jpg') }}"></a>
            </div><!-- Feature inner End -->
            <!-- Post Content Start -->
            <div class="post-content">
                <p>Internet Explorer has long been the bane of
                    many Web developers’ existence, but here’s some
                    news to brighten your day: Internet Explorer 8,
                    9 and 10 are <a href="https://www.microsoft.com/en-us/WindowsForBusiness/End-of-IE-support" target="_blank">reaching&nbsp;‘end of life’ on Tuesday</a>, meaning they’re no longer supported by Microsoft.</p>
                <p>A patch, <a href="https://support.microsoft.com/en-us/kb/3123303?sd=rss&amp;spid=14019" target="_blank">which goes live on January 12</a>, will nag Internet Explorer users on
                    launch to upgrade to a modern browser. <a href="https://support.microsoft.com/en-us/kb/3123303?sd=rss&amp;spid=14019" target="_blank">KB3123303</a> adds the&nbsp;nag
                    box, which will appear for Windows 7 and Server
                    2008 R2 users still using the old browsers
                    after installing the update.</p>
                <p>It’s great news for developers who still
                    need to target older browsers — not needing to
                    worry about whether or not modern CSS works in
                    these browsers is a dream, and it’s much closer
                    with this move.</p>
            </div><!-- Post Content End -->
            <div class="entry-more">
                <div class="pull-left">
                    <a class="btn btn-common" href="#">Read More <i class="ico-arrow-right"></i></a>
                </div>
                <div class="share-icon pull-right">
                    <span class="socialShare"></span>
                </div>
            </div>
        </div><!-- Blog item End -->
    </article>

@endsection

