<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}@hasSection ('ex-title') - @yield('ex-title') @endif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta property="og:title" content="{{ config('app.name') }}@hasSection ('ex-title') - @yield('ex-title') @endif"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:image" content="@hasSection('image')@yield('image')@else{{asset('favicon.ico')}}@endif"/>
    <meta property="og:image:type" content="image/jpeg"/>
    <meta property="og:image:alt" content="{{ config('app.name') }}@hasSection ('ex-title') - @yield('ex-title') @endif"/>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('style')
</head>

<body class="p-0 m-0 bg-slate-100" dir="rtl">
@include('layouts.header')

<section class="container mx-auto mt-4 grid grid-cols-7 gap-6">
    @include('layouts.aside')

    <div class="col-span-5">
        @yield('content')
    </div>
</section>

<footer class="mt-6 shadow shadow-rp-500/50">
    <div class="container mx-auto">
        <p class="text-left italic pt-4 text-slate-500" dir="ltr">
            © Copyright 2023 Rp76, All rights reserved.
        </p>
    </div>
</footer>

<script src="{{ mix('js/app.js') }}"></script>

@yield('script')
</body>
</html>
