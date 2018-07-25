<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intimate - Forgot Password</title>
    <link href="{{ asset('Admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Admin/css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('Admin/css/styles.css') }}" rel="stylesheet">
</head>
<body>
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Forgot Password</div>
            <div class="panel-body">
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if(session('success'))
                    <div class="alert alert-danger">{{ session('success') }}</div>
                @endif
                <form role="form" method="post" action="{{ route('forgot_password') }}">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Enter Email" name="email" type="email">
                            @if($errors->has('email'))
                                <label class="text-danger">{{ $errors->first('email') }}</label>
                            @endif
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="panel-footer">
                <div class="text-center">
                    <a href="{{route('get_login')}}" class="text-primary">Back to Login</a>
                </div>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->


<script src="{{ asset('Admin/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('Admin/js/bootstrap.min.js') }}"></script>
</body>
</html>
