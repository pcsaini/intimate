@extends('super.master')

@section('page_title', 'Reply - Intimate Blog')

@section('style')
    <link href="{{ asset('Admin/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{ route('super.dashboard') }}">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li><a href="{{ route('super.get_posts') }}">
                        Posts
                    </a></li>
                <li class="active">Comments</li>
                <li class="active">Reply</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Reply
                        <a class="btn btn-primary pull-right" href="{{ route('super.get_add_reply',$comment_id) }}">Add Reply</a>
                    </div>
                    <div class="panel-body">

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <table id="category" class="table table-bordered table-hover" style="width: 100%;">
                            <thead>
                            <tr>
                                <th>Author Name</th>
                                <th>Email</th>
                                <th>Reply</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Author Name</th>
                                <th>Email</th>
                                <th>Reply</th>
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
            $('#category').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": "{{ route('super.reply',$comment_id) }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "author" },
                    { "data": "email" },
                    { "data": "reply" },
                    { "data": "options"},
                ]
            });
        });
    </script>
@endsection