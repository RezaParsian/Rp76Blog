<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} | {{$user->name}} | {{@$user->getMeta("profile_name")->value}}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?id={{filemtime('css/app.css')}}">

    <meta property="og:title" content="{{ env('APP_NAME') }} | {{$user->name}} | {{@$user->getMeta("profile_name")->value}}" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:image" content="{{asset('upload/profile/'.$user->image)}}" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:alt" content="{{$user->getMeta("profile_about")->value}}" />

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
            <h2>{{ env('APP_NAME') }} | {{$user->name}} | {{@$user->getMeta("profile_name")->value}}</h2>
            <div class="site-breadcrumb">
            </div>
        </div>
    </section>
    <!-- Page top end-->

    <!-- Blog page -->
    <section class="blog-page">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div class="card-body row">
                        @php
                            /**
                             * @var $user \App\Models\User
                             */
                            $edit=auth()->id()==$user->id ? 'contenteditable="true"' : "";
                        @endphp
                        <div class="col-md-3 p-0">
                            <img src="{{asset('upload/profile/'.$user->image)}}" alt="{{$user->getMeta("profile_name")->value ?? $user->name}}" class="img-thumbnail">
                            @if(auth()->id()==$user->id)
                                <button class="btn btn-info mx-auto btn-block" onclick="$(`[name='image']`).click()">بارگذاری عکس</button>
                            @endif
                        </div>
                        <div class="col-md bg-twit rounded rtl p-3">
                            <h3 class="border-bottom p-2" {{$edit}} id="name">{{$user->getMeta("profile_name")->value ?? "ویرایش نام" }}</h3>
                            <p {{$edit}} style="white-space: pre-line" id="about">{{$user->getMeta("profile_about")->value ?? "ویرایش درباره من"}}</p>
                            <div class="row justify-content-around">
                                <a href="tel:{{@$user->getMeta("profile_phone")->value}}" id="phone" {{$edit}} title="شماره تماس" data-toggle="tooltip" class="text-blog">{{$user->getMeta("profile_phone")->value ?? "ویرایش شماره تماس"}}</a>
                                <a href="mailto:{{@$user->getMeta("profile_mail")->value}}" id="mail" {{$edit}} title="ایمیل" data-toggle="tooltip" class="text-bold">{{$user->getMeta("profile_mail")->value ?? "ویرایش ایمیل"}}</a>
                            </div>
                            <hr class="shadow">
                            @if(auth()->id()==$user->id)
                                <form action="{{route('profile.save',$user->name)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" hidden name="image" accept="image/*">
                                    <input type="hidden" name="name">
                                    <input type="hidden" name="about">
                                    <input type="hidden" name="phone">
                                    <input type="hidden" name="mail">
                                    <button class="btn btn-success float-left px-5" id="submit">ثبت</button>
                                </form>
                            @endif
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
<script>
    $("#submit").click(function () {
        $("[name='name']").val($("#name").text());
        $("[name='about']").val($("#about").text());
        $("[name='phone']").val($("#phone").text());
        $("[name='mail']").val($("#mail").text());
        $(this).parent().submit();
    });
</script>
</body>
</html>
