<!-- Header Section Start -->
<header class="site-header">
    <nav class="navbar navbar-default navbar-intimate role="
         data-offset-top="50" data-spy="affix">
        <div class="container">
            <div class="navbar-header">
                <!-- Start Toggle Nav For Mobile -->
                <button class="navbar-toggle" data-target="#navigation"
                        data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <div class="logo">
                    <a class="navbar-brand" href="/"><i class="ico-3dglasses"></i></a>
                </div>
            </div><!-- Stat Search -->
            <div class="side">
                <a class="show-search"><i class="ico-search"></i></a>
            </div><!-- Form for navbar search area -->
            <form class="full-search">
                <div class="container">
                    <div class="row">
                        <input class="form-control" placeholder="Search" type="text"> <a class="close-search"><span class="ico-times"></span></a>
                    </div>
                </div>
            </form><!-- Search form ends -->
            <!-- Navigation Start -->
            <div class="navbar-collapse collapse" id="navigation">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        $i = 0;
                        $dropdown_start = false;
                        foreach ($category as $cat){
                            $i++;
                            $cat_id = $cat->id;
                            $cat_name = $cat->category;
                            $cat_url = str_replace(' ','-',strtolower($cat->category));
                            if ($i < 5){?>
                                <li class="{{ Request::url() != route('blog.post_by_category',[$cat_id,$cat_url]) ? "" : "active"}}"><a href="{{route('blog.post_by_category',[$cat_id,$cat_url])}}">{{$cat_name}}</a></li>
                            <?php }else{
                                if ($i == 5){
                                    $dropdown_start = true;
                                    echo '<li class="dropdown dropdown-toggle">
                                                <a data-toggle="dropdown" href=
                                                "#">More +</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="'.route('blog.post_by_category',[$cat_id,$cat_url]).'">'.$cat_name.'</a></li>';
                                }else{
                                    echo '<li><a href="'.route('blog.post_by_category',[$cat_id,$cat_url]).'">'.$cat_name.'</a></li>';
                                }
                            }
                        }
                        if ($dropdown_start){
                            echo '</ul></li>';
                        }
                    ?>
                </ul>
            </div><!-- Navigation End -->
        </div>
    </nav><!-- Mobile Menu Start -->
    <ul class="wpb-mobile-menu">
        @foreach($category as $cat)
            <li class="{{ Request::url() != route('blog.post_by_category',[$cat->id,str_replace(' ','-',strtolower($cat->category))]) ? "" : "active"}}"><a href="{{ route('blog.post_by_category',[$cat_id,str_replace(' ','-',strtolower($cat->category))]) }}">{{$cat->category}}</a></li>
        @endforeach
    </ul><!-- Mobile Menu End -->
</header><!-- Header Section End -->

