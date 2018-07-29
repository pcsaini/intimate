@extends('super.master')

@section('page_title', 'Post | Intimate Blog')

@section('style')
    <link href="{{ asset('Admin/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Post</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Posts
                        <a href="{{ route('super.get_add_post') }}" class="btn btn-primary pull-right">Add New Post</a>
                    </div>
                    <div class="panel panel-body">

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <table id="posts" class="table table-bordered table-hover" style="width: 100%;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Post Title</th>
                                <th>Post Category</th>
                                <th>Post Tags</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Post Title</th>
                                <th>Post Category</th>
                                <th>Post Tags</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>
@endsection

@section('script')
    <script src="{{ asset('Admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Admin/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#posts').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": "{{ route('super.posts') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "post_title" },
                    { "data": "post_category" },
                    { "data": "post_tags" },
                    { "data": "status" },
                    { "data": "options"},
                ]
            });
        });
    </script>
@endsection