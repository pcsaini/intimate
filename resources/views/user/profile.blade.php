@extends('super.master')

@section('page_title', 'Profile | Intimate Blog')

@section('style')
    <style>
        .entry-widget {
            background: #fff;
            position: relative;
            margin-bottom: 30px;
            box-shadow: 2px 2px 8px rgba(45, 45, 45, 0.36);
        }
        .widget-profile .image {
            overflow: hidden;
            position: relative;
            height: 168px;
        }
        .widget-profile .portfolio {
            position: absolute;
            top: 16%;
            border-radius: 50%;
            width: 120px;
            border: 3px solid #ffffff;
            height: 120px;
            overflow: hidden;
            left: 32%;
        }
        .widget-profile img{
            width: 100%;
        }
        .widget-profile .info {
            text-align: center;
            padding: 30px 30px 18px;
        }
        .widget-profile .info .name {
            font-size: 22px;
            margin-top: 25px;
            margin-bottom: 20px;
        }
        .social-links {
            margin-top: 20px;
        }
        .social-links a {
            background: #FFF;
            font-size: 15px;
            border: 1px solid #E1E1E1;
            color: #AAA;
            border-radius: 100%;
            display: inline-block;
            height: 40px;
            line-height: 40px;
            margin: 0px 6px 6px 0px;
            text-align: center;
            width: 40px;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .social-links .twitter {
            color: #00ACED;
        }
        .social-links .twitter:hover {
            border: 1px solid #00ACED;
        }
        .social-links .facebook {
            color: #3B5998;
        }
        .social-links .facebook:hover {
            border: 1px solid #3B5998;
        }
        .social-links .google-plus {
            color: #DD4B39;
        }
        .social-links .google-plus:hover {
            border: 1px solid #DD4B39;
        }
        .social-links .linkedin {
            color: #007BB6;
        }
        .social-links .linkedin:hover {
            border: 1px solid #007BB6;
        }
    </style>
@endsection

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Profile</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Profile</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="entry-widget">
                            <div class="widget-profile">
                                <div class="image"><img alt="" src="{{ asset('Blog/img/cover.jpg') }}"></div>
                                <div class="portfolio"><img alt="" src="{{ asset('profile_pic/'.$user->profile_pic) }}"></div>
                                <div class="info">
                                    <h3 class="name">{{ $user->name }}</h3>
                                    <p class="details">{{ $user->bio }}</p>
                                    <div class="social-links">
                                        <a class="twitter social-link" data-placement="top" data-toggle="tooltip" href="{{ $user->twitter_url }}" title="Twitter"><i class="fa fa-twitter"></i></a>
                                        <a class="facebook social-link" data-placement="top" data-toggle="tooltip" href="{{ $user->facebook_url }}" title="Facebook"><i class="fa fa-facebook"></i></a>
                                        <a class="google-plus social-link" data-placement="top" data-toggle="tooltip" href="{{ $user->google_plus_url }}" title="Google+"><i class="fa fa-google-plus"></i></a>
                                        <a class="linkedin social-link" data-placement="top" data-toggle="tooltip" href="{{ $user->instagram_url }}" title="Instagram"><i class="fa fa-instagram"></i></a>
                                        <a class="linkedin social-link" data-placement="top" data-toggle="tooltip" href="{{ $user->linkedin_url }}" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Profile
                            </div>
                            <div class="panel-body">
                                @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <form class="form-horizontal" action="{{ route('user.profile') }}" method="post" enctype="multipart/form-data">
                                    <fieldset>
                                    @csrf
                                    <!-- Name input-->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Name</label>
                                            <div class="col-md-9">
                                                <input name="name" type="text" placeholder="Your name" class="form-control" value="{{ old('name') == '' ? $user->name : old('name')}}">
                                                @if($errors->has('name'))
                                                    <label class="text-danger">{{ $errors->first('name') }}</label>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Email input-->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="email">Email</label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="Your email" class="form-control" disabled="" value="{{ $user->email }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Profile Pic</label>
                                            <div class="col-md-9">
                                                <input name="profile_pic" type="file" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Facebook Url</label>
                                            <div class="col-md-9">
                                                <input name="facebook_url" type="text" placeholder="Facebook Url" class="form-control" value="{{ old('facebook_url') == '' ? $user->facebook_url : old('facebook_url')}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Twitter Url</label>
                                            <div class="col-md-9">
                                                <input name="twitter_url" type="text" placeholder="Twitter Url" class="form-control" value="{{ old('twitter_url') == '' ? $user->twitter_url : old('twitter_url')}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Google+ Url</label>
                                            <div class="col-md-9">
                                                <input name="google_plus_url" type="text" placeholder="Google+ Url" class="form-control" value="{{ old('google_plus_url') == '' ? $user->google_plus_url : old('google_plus_url')}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Instagram Url</label>
                                            <div class="col-md-9">
                                                <input name="instagram_url" type="text" placeholder="Instagram Url" class="form-control" value="{{ old('instagram_url') == '' ? $user->instagram_url : old('instagram_url')}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">LinkedIn Url</label>
                                            <div class="col-md-9">
                                                <input name="linkedin_url" type="text" placeholder="LinkedIn url" class="form-control" value="{{ old('linkedin_url') == '' ? $user->linkedin_url : old('linkedin_url')}}">
                                            </div>
                                        </div>

                                        <!-- Message body -->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="message">Your Bio</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" name="bio" placeholder="Please enter your Bio here..." rows="5">{{ old('bio') == '' ? $user->bio : old('bio')}}</textarea>
                                            </div>
                                        </div>

                                        <!-- Form actions -->
                                        <div class="form-group">
                                            <div class="col-md-12 widget-right">
                                                <button type="submit" class="btn btn-default btn-md pull-right">Submit</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p class="back-link">Lumino Theme by <a href="https://www.medialoot.com">Medialoot</a></p>
                </div>
            </div><!--/.row-->
        </div><!--/.row-->
    </div>
@endsection