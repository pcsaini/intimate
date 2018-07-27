<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title')</title>
    <link href="{{ asset('Admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Admin/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Admin/css/datepicker3.css') }}" rel="stylesheet">
    @yield('style')
    <link href="{{ asset('Admin/css/styles.css') }}" rel="stylesheet">
    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
@include('super.header')

@include('super.sidebar')

@yield('content')

<script src="{{ asset('Admin/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('Admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('Admin/js/respond.min.js') }}"></script>
<script src="{{ asset('Admin/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('Admin/js/custom.js') }}"></script>
@yield('script')
</body>
</html>