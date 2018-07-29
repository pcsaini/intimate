@extends('super.master')

@section('page_title', 'Add New User - Intimate Blog')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Add User</li>
            </ol>
        </div><!--/.row-->

        <div class="row">

            <div class="col-lg-6 col-lg-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Add User
                    </div>
                    <div class="panel-body">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form role="form" method="post" action="{{ route('super.save_user') }}">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" placeholder="Enter Name" name="name" type="text" value="{{ old('name')}}">
                                @if($errors->has('name'))
                                    <label class="text-danger">{{ $errors->first('name') }}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Enter Email" name="email" type="email" value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <label class="text-danger">{{ $errors->first('email') }}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Enter Password" name="password" type="password" value="{{ old('password') }}">
                                @if($errors->has('password'))
                                    <label class="text-danger">{{ $errors->first('password') }}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Confirm Password" name="confirm_password" type="password" value="{{ old('confirm_password') }}">
                                @if($errors->has('confirm_password'))
                                    <label class="text-danger">{{ $errors->first('confirm_password') }}</label>
                                @endif
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div><!--/.row-->
    </div>
@endsection