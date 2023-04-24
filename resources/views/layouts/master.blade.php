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

<body class="p-0 m-0 bg-slate-100 dark:bg-zinc-800" dir="rtl">
<header class="bg-white dark:bg-zinc-800 shadow dark:shadow-rp-900 py-4 sticky top-0 z-50">
    @include('layouts.header')
</header>

<section class="container mx-auto mt-4 grid md:grid-cols-7 gap-6">
    <aside class="md:col-span-2 order-2 md:order-1 px-3 md:px-0">
        @include('layouts.aside')
    </aside>

    <div class="md:col-span-5 order-1 md:order-2 mt-4 md:mt-0 px-3 md:px-0">
        @yield('content')
    </div>
</section>

@include('layouts.footer')

<script src="{{ mix('js/app.js') }}"></script>

@yield('script')
</body>
</html>
