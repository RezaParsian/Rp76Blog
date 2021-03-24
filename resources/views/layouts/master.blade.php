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
        @yield('body')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('ex-js')
</html>
