<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}@hasSection ('ex-title') - @yield('ex-title') @endif</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?id={{filemtime('css/app.css')}}">
    @yield('ex-css')


    <meta property="og:title" content="{{ env('APP_NAME') }}@hasSection ('ex-title') - @yield('ex-title') @endif" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:alt" content="{{ env('APP_NAME') }}@hasSection ('ex-title') - @yield('ex-title') @endif" />
</head>

<body class="ltr">
<div class="container-fluid p-0" id="app">
    <!-- Page Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <!-- Header section -->
@include("layouts.navbar")
<!-- Header section end -->


    <!-- Page top section -->
    <section class="page-top-section" id="topHeader">
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
                <div class="col-xl-9 col-lg-8 col-md-7">
                    @yield('body')
                </div>
                <div class="col-xl-3 col-lg-4 col-md-5 sidebar">
                    <div id="stickySidebar">
                        <div class="widget-item">
                            <form class="search-widget">
                                <input type="text" name="q">
                                <button type="submit">جستجو</button>
                            </form>
                        </div>
                        <div class="widget-item">
                            <h4 class="widget-title">بلاگ های پرطرفدار</h4>
                            <div class="trending-widget">
                                <h5 class="text-muted text-center">بلاگی وجود ندارد.</h5>
{{--                                <div class="tw-item">--}}
{{--                                    <div class="tw-thumb">--}}
{{--                                        <img src="{{asset("img/blog-widget/1.jpg")}}" alt="#">--}}
{{--                                    </div>--}}
{{--                                    <div class="tw-text">--}}
{{--                                        <div class="tw-meta">11.11.18 / in <a href="">Games</a></div>--}}
{{--                                        <h5>The best online game is out now!</h5>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <div class="widget-item">
                            <div class="categories-widget rtl">
                                <h4 class="widget-title text-center p-0">دسته بندی ها</h4>
                                <ul class="p-0 pr-3">
                                    @foreach($cats as $category)
                                        <li><a href="">{{$category->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="widget-item rtl">
                            <h4 class="widget-title text-center p-0">توییت ها</h4>
                            <div class="latest-comments">
                                @forelse($twits as $twit)
                                    <div class="lc-item ">
                                        <div class="tw-text text-warning sma twit">
                                            {!! $twit->markdown !!}
                                            <small dir="ltr" class="float-left text-warning">{{$twit->created_at_p}}</small>
                                        </div>
                                    </div>
                                    <hr>
                                @empty
                                    <h5 class="text-muted text-center">توییتی وجود ندارد.</h5>
                                @endforelse
                            </div>
                        </div>
                        <div class="widget-item" style="min-height: 5rem">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog page end-->
    <!-- Newsletter section -->
    <section class="newsletter-section position-relative">
        <scrolltotop></scrolltotop>
        <div class="container">
            <h2 class="rtl text-center">مشترک خبرنامه ما شوید.</h2>
            <form class="newsletter-form">
                <input type="text" placeholder="ایمیل شما">
                <button class="site-btn">اشتراک <img src="{{asset("img/icons/double-arrow.png")}}" alt="arrow"/></button>
            </form>
        </div>
    </section>
    <!-- Newsletter section end -->


    <!-- Footer section -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-left-pic"></div>
            <a href="https://api.whatsapp.com/send/?phone=%2B989174811484&text&app_absent=0" target="_blank" title="whatsapp" class="footer-logo">
                <img src="{{ asset('favicon.ico') }}" alt="Whatsapp">
            </a>
            {{-- <ul class="main-menu footer-meslicknav_btn slicknav_collapsedu">
                <li><a href="">Home</a></li>
                <li><a href="">Games</a></li>
                <li><a href="">Reviews</a></li>
                <li><a href="">News</a></li>
                <li><a href="">Contact</a></li>
            </ul> --}}
            <div class="footer-social d-flex justify-content-center">
                <social></social>
            </div>
            <div class="copyright" data-toggle="tooltip" title="Rp76 2021 @ All rights reserved">
                <a href="" class="text-info">Rp76</a> 2021 @ All rights reserved
            </div>
        </div>
    </footer>
    <!-- Footer section end -->
</div>
<script src="{{ asset('js/app.js') }}?id={{filemtime('js/app.js')}}"></script>
@yield('ex-js')

</html>
