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
    @include('layouts.blog.header')
</header>

<section class="container mx-auto mt-4 grid grid-cols-1 md:grid-cols-7 gap-6">
    <aside class="md:col-span-2 order-2 md:order-1 px-3 md:px-0">
        @include('layouts.panel.aside')
    </aside>

    <div class="md:col-span-5 order-1 md:order-2 mt-4 bg-white dark:bg-stone-800 rounded-3xl p-6">
        @yield('content')
    </div>
</section>

@include('layouts.blog.footer')

<script src="{{ mix('js/app.js') }}"></script>

@if(session('msg') or session('errors'))
    <script>
        let msg;
        let errors;

        @if(session('msg'))
            msg =@json(session('msg'));
        @endif

            @if(session('errors'))
            errors = {!! session('errors') !!};
        @endif

        setTimeout(() => {
            if (msg)
                swal.fire('موفقیت', msg, 'success');

            if (errors) {
                swal.fire({
                    title: '‌خطا!',
                    html: 'اعتبارسنجی فرم با شکست مواجه شد.',
                    icon: 'error',
                    confirmButtonText: 'بستن'
                });

                Object.keys(errors).forEach(error => {
                    const $field = $(`[name='${error}']`);

                    $field.after(`<p class="text-red-400 text-xs m-0">${errors[error]}</p>`);
                    $field.addClass("!border-red-400");
                });
            }
        }, 250);
    </script>
@endif

@yield('script')
</body>
</html>
