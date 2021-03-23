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
</head>

<body>
    <div class="container" id="app">
        <div id="markdown">
            {!! $b !!}
        </div>
        <form action="">
            <markdown></markdown>
            <input type="submit" value="Go" id="btnform">
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
