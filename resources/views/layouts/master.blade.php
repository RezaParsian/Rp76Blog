<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{ env('APP_NAME') }}
        @hasSection ('ex-title')

            - @yield('ex-title')
        @endif
    </title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('ex-css')
</head>

<body>
    <div class="container-fluid p-0" id="app">
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>

        <!-- Header section -->
        <header class="header-section">
            <div class="header-warp">
                <div class="header-social d-flex justify-content-end">
                    <p>Follow us:</p>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-behance"></i></a>
                </div>
                <div class="header-bar-warp d-flex">
                    <!-- site logo -->
                    <div class="user-panel w-25">
                        <a href="">Login</a> / <a href="">Register</a>
                    </div>
                    <nav class="top-nav-area w-100">
                        <a href="index.html" class="site-logo p-1">
                            <h1 class="text-white p-0">برنامه نویس کوچک</h1>
                        </a>
                        <!--Menu -->
                        <ul id="menu" class="main-menu primary-menu rtl">
                            <li><a href="index.html">خانه</a></li>
                            <li><a href="games.html">بازی</a>
                                <ul class="sub-menu">
                                    <li><a href="game-single.html">بازی ۱</a></li>
                                </ul>
                            </li>
                            <li><a href="review.html">نظرات</a></li>
                            <li><a href="blog.html">اخبار</a></li>
                            <li><a href="contact.html">تماس با ما</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <!-- Header section end -->


        <!-- Page top section -->
        <section class="page-top-section" id="topheader">
            <div class="page-info rtl">
                <h2>مطالب اخیر</h2>
                <div class="site-breadcrumb">
                    <span>وبلاگ</span>
                </div>
            </div>
        </section>
        <!-- Page top end-->

        <!-- Blog page -->
        <section class="blog-page">
            <div class="container">
                <div class="row">

                    @yield('body')

                    <div class="col-xl-3 col-lg-4 col-md-5 sidebar">
                        <div id="stickySidebar">
                            <div class="widget-item">
                                <form class="search-widget">
                                    <input type="text">
                                    <button>search</button>
                                </form>
                            </div>
                            <div class="widget-item">
                                <h4 class="widget-title">Trending</h4>
                                <div class="trending-widget">
                                    <div class="tw-item">
                                        <div class="tw-thumb">
                                            <img src="./img/blog-widget/1.jpg" alt="#">
                                        </div>
                                        <div class="tw-text">
                                            <div class="tw-meta">11.11.18 / in <a href="">Games</a></div>
                                            <h5>The best online game is out now!</h5>
                                        </div>
                                    </div>
                                    <div class="tw-item">
                                        <div class="tw-thumb">
                                            <img src="./img/blog-widget/2.jpg" alt="#">
                                        </div>
                                        <div class="tw-text">
                                            <div class="tw-meta">11.11.18 / in <a href="">Games</a></div>
                                            <h5>The best online game is out now!</h5>
                                        </div>
                                    </div>
                                    <div class="tw-item">
                                        <div class="tw-thumb">
                                            <img src="./img/blog-widget/3.jpg" alt="#">
                                        </div>
                                        <div class="tw-text">
                                            <div class="tw-meta">11.11.18 / in <a href="">Games</a></div>
                                            <h5>The best online game is out now!</h5>
                                        </div>
                                    </div>
                                    <div class="tw-item">
                                        <div class="tw-thumb">
                                            <img src="./img/blog-widget/4.jpg" alt="#">
                                        </div>
                                        <div class="tw-text">
                                            <div class="tw-meta">11.11.18 / in <a href="">Games</a></div>
                                            <h5>The best online game is out now!</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-item">
                                <div class="categories-widget">
                                    <h4 class="widget-title">categories</h4>
                                    <ul>
                                        <li><a href="">Games</a></li>
                                        <li><a href="">Gaming Tips & Tricks</a></li>
                                        <li><a href="">Online Games</a></li>
                                        <li><a href="">Team Games</a></li>
                                        <li><a href="">Community</a></li>
                                        <li><a href="">Uncategorized</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget-item">
                                <h4 class="widget-title">Latest Comments</h4>
                                <div class="latest-comments">
                                    <div class="lc-item">
                                        <img src="./img/blog-widget/1.jpg" class="lc-avatar" alt="#">
                                        <div class="tw-text"><a href="">Maria Smith</a> <span>On</span> The best online
                                            game out
                                            there </div>
                                    </div>
                                    <div class="lc-item">
                                        <img src="./img/blog-widget/2.jpg" class="lc-avatar" alt="#">
                                        <div class="tw-text"><a href="">Maria Smith</a> <span>On</span> The best online
                                            game out
                                            there </div>
                                    </div>
                                    <div class="lc-item">
                                        <img src="./img/blog-widget/3.jpg" class="lc-avatar" alt="#">
                                        <div class="tw-text"><a href="">Maria Smith</a> <span>On</span> The best online
                                            game out
                                            there </div>
                                    </div>
                                    <div class="lc-item">
                                        <img src="./img/blog-widget/4.jpg" class="lc-avatar" alt="#">
                                        <div class="tw-text"><a href="">Maria Smith</a> <span>On</span> The best online
                                            game out
                                            there </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-item">
                                <a href="#" class="add">
                                    <img src="./img/add.jpg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog page end-->


        <!-- Newsletter section -->
        <section class="newsletter-section">
            <div class="container">
                <h2>Subscribe to our newsletter</h2>
                <form class="newsletter-form">
                    <input type="text" placeholder="ENTER YOUR E-MAIL">
                    <button class="site-btn">subscribe <img src="img/icons/double-arrow.png" alt="#" /></button>
                </form>
            </div>
        </section>
        <!-- Newsletter section end -->


        <!-- Footer section -->
        <footer class="footer-section">
            <div class="container">
                <div class="footer-left-pic">
                    <img src="img/footer-left-pic.png" alt="">
                </div>
                <div class="footer-right-pic">
                    <img src="img/footer-right-pic.png" alt="">
                </div>
                <a href="#" class="footer-logo">
                    <img src="{{ asset('favicon.ico') }}" alt="">
                </a>
                <ul class="main-menu footer-meslicknav_btn slicknav_collapsedu">
                    <li><a href="">Home</a></li>
                    <li><a href="">Games</a></li>
                    <li><a href="">Reviews</a></li>
                    <li><a href="">News</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
                <div class="footer-social d-flex justify-content-center">
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-behance"></i></a>
                </div>
                <div class="copyright"><a href="">Colorlib</a> 2018 @ All rights reserved</div>
            </div>
        </footer>
        <!-- Footer section end -->
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('ex-js')

</html>