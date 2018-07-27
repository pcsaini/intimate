@extends('super.master')

@section('page_title', 'Post | Intimate Blog')

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
                        Posts Collections
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>
@endsection