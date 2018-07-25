<!DOCTYPE html>
<!--[if IE 8 ]>
<html class="ie ie8" lang="en">
<![endif]-->
<!--[if (gte IE 9)|!(IE)]>
<html lang="en" class="no-js">
<![endif]-->
<html lang="en">
<head>
    <title>@yield('page_title')</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <!-- Page Description and Author -->
    <meta content="Intimate - Blog" name="description">
    <meta content="Prem Chand Saini" name="author"><!-- Bootstrap Css -->
    <link href="{{ asset('Blog/css/bootstrap.min.css') }}" madia="screen" rel="stylesheet" type="text/css">
    <!-- Font Icon Css -->
    <link href="{{ asset('Blog/fonts/font-awesome.min.css') }}" madia="screen" rel="stylesheet" type="text/css">
    <link href="{{ asset('Blog/fonts/intimate-fonts.css') }}" madia="screen" rel="stylesheet" type="text/css">
    <!-- Main Css Styles -->
    <link href="{{ asset('Blog/css/main.css') }}" madia="screen" rel="stylesheet" type="text/css">
    <!-- Owl Carousel -->
    <link href="{{ asset('Blog/extras/owl/owl.carousel.css') }}" media="screen" rel="stylesheet" type="text/css">
    <link href="{{ asset('Blog/extras/owl/owl.theme.css') }}" media="screen" rel="stylesheet" type="text/css">
    <link href="{{ asset('Blog/extras/animate.css') }}" media="screen" rel="stylesheet" type="text/css">
    <link href="{{ asset('Blog/extras/lightbox.css') }}" media="screen" rel="stylesheet" type="text/css">
    <link href="{{ asset('Blog/extras/slicknav.css') }}" media="screen" rel="stylesheet" type="text/css">
    <!-- Responsive Css Styles -->
    <link href="{{ asset('Blog/css/responsive.css') }}" madia="screen" rel="stylesheet" type="text/css">
    @yield('stylesheet')
</head>
<body>
<!-- Header Section Start -->
@include('layouts.header')
<!-- Header Section End -->
<!-- Hero Area Start -->
@yield('hero')
<!-- Hero Area End -->
<!-- Content Start -->
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                {{-- Content Here--}}
                @yield('content')
            </div>
            <div class="col-md-4">
                {{-- Sidebar Start--}}
                @include('layouts.sidebar')
                {{--Sidebar End--}}
            </div>
        </div>
    </div>
</div><!-- Content End -->
<!-- Footer Start -->
@include('layouts.footer')
<!-- Footer End -->
<!-- js  -->
<script src="{{ asset('Blog/js/jquery-min.js') }}" type="text/javascript"></script>
<script src="{{ asset('Blog/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('Blog/js/owl.carousel.js') }}" type="text/javascript"></script>
<script src="{{ asset('Blog/js/jquery.mixitup.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('Blog/js/lightbox.js') }}" type="text/javascript"></script>
<script src="{{ asset('Blog/js/plugin.js') }}" type="text/javascript"></script>
<script src="{{ asset('Blog/js/jquery.slicknav.js') }}" type="text/javascript"></script>
<script src="{{ asset('Blog/js/count-to.js') }}" type="text/javascript"></script>
<script src="{{ asset('Blog/js/jquery.appear.js') }}" type="text/javascript"></script>
<script src="{{ asset('Blog/js//main.js') }}" type="text/javascript"></script>

@yield('script')

</body>
</html>