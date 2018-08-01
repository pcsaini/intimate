<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        {{--<div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>--}}
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">{{ Auth::user()->name }}</div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
   {{-- <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>--}}
    <ul class="nav menu">
        @if(Auth::user()->is_admin)
            <li class="{{Route::currentRouteName() == 'super.dashboard' ? 'active' : ' '}}"><a href="{{route('super.dashboard')}}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <li class="{{Route::currentRouteName() == 'super.get_users' ? 'active' : ' '}}"><a href="{{ route('super.get_users') }}"><em class="fa fa-user-plus">&nbsp;</em> User Management</a></li>
            <li class="{{Route::currentRouteName() == 'super.get_category' ? 'active' : ' '}}"><a href="{{ route('super.get_category') }}"><em class="fa fa-align-justify">&nbsp;</em> Category</a></li>
            <li class="{{Route::currentRouteName() == 'super.get_posts' ? 'active' : ' '}}"><a href="{{ route('super.get_posts') }}"><em class="fa fa-edit">&nbsp;</em> Posts</a></li>
            <li class="{{Route::currentRouteName() == 'super.get_add_post' ? 'active' : ' '}}"><a href="{{ route('super.get_add_post') }}"><em class="fa fa-pencil-square">&nbsp;</em> Add New Post</a></li>
            <li class="{{Route::currentRouteName() == 'super.get_profile' ? 'active' : ' '}}"><a href="{{ route('super.get_profile') }}"><em class="fa fa-user">&nbsp;</em> Profile</a></li>
        @else
            <li class="{{Route::currentRouteName() == 'user.dashboard' ? 'active' : ' '}}"><a href="{{ route('user.dashboard') }}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <li class="{{Route::currentRouteName() == 'user.get_category' ? 'active' : ' '}}"><a href="{{ route('user.get_category') }}"><em class="fa fa-align-justify">&nbsp;</em> Category</a></li>
            <li class="{{Route::currentRouteName() == 'user.get_posts' ? 'active' : ' '}}"><a href="{{ route('user.get_posts') }}"><em class="fa fa-edit">&nbsp;</em> Posts</a></li>
            <li class="{{Route::currentRouteName() == 'user.get_add_post' ? 'active' : ' '}}"><a href="{{ route('user.get_add_post') }}"><em class="fa fa-pencil-square">&nbsp;</em> Add New Post</a></li>
            <li class="{{Route::currentRouteName() == 'user.get_profile' ? 'active' : ' '}}"><a href="{{ route('user.get_profile') }}"><em class="fa fa-user">&nbsp;</em> Profile</a></li>
        @endif
            <li><a href="{{ route('logout') }}"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
</div><!--/.sidebar-->