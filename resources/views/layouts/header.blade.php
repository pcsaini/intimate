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
                            if ($i < 5){
                                echo '<li><a href="#">'.$cat_name.'</a></li>';
                            }else{
                                if ($i == 5){
                                    $dropdown_start = true;
                                    echo '<li class="dropdown dropdown-toggle active">
                                                <a data-toggle="dropdown" href=
                                                "#">More +</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">'.$cat_name.'</a></li>';
                                }else{
                                    echo '<li><a href="#">'.$cat_name.'</a></li>';
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
        <li class="active">
            <a href="#">Home</a>
            <ul>
                <li>
                    <a href="fullscreen-slider.html">Home - Fullscreen
                        Slider</a>
                </li>
                <li>
                    <a href="carousel-slider.html">Home - Post Carousel</a>
                </li>
                <li class="active">
                    <a href="index.html">Home - Default</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">Portfolio</a>
            <ul>
                <li>
                    <a href="portfolio-col-3.html">Portfolio 3 column</a>
                </li>
                <li>
                    <a href="portfolio-col-4.html">Portfolio 4 column</a>
                </li>
                <li>
                    <a href="portfolio-item.html">Single Project</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">Blog</a>
            <ul>
                <li>
                    <a href="blog.html">Blog View</a>
                </li>
                <li>
                    <a href="single.html">Single Post</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="contact.html">Contact</a>
        </li>
        <li>
            <a href="#">Download</a>
        </li>
    </ul><!-- Mobile Menu End -->
</header><!-- Header Section End -->

