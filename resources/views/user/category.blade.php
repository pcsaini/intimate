@extends('super.master')

@section('page_title', 'Category - Intimate Blog')

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
                <li class="active">Category</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Category
                        <a class="btn btn-primary pull-right" href="{{ route('user.get_add_category') }}">Add New Category</a>
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
                                <th>ID</th>
                                <th>Category</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Status</th>
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
                    "url": "{{ route('user.category') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "category" },
                    { "data": "status" },
                ]
            });
        });
    </script>
@endsection