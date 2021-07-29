<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{env("APP_NAME")}} - @yield("ex-title")</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
</head>
<body class="hold-transition sidebar-mini rtl">
<div class="wrapper rpwarper" id="app">

    @include("layouts.dashboard.navbar")

    @include("layouts.dashboard.sidebar")

    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield("ex-title")</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @yield("content")
            </div>
        </section>

    </div>

    <footer class="main-footer">
        <p class="text-center">CopyRight &copy; {{\Carbon\Carbon::now()->year}} <a href="http://github.com/rezaparsian/" class="text-success">رضا پارسیان</a> by <label class="text-danger">♥</label> and ☕</p>
    </footer>

    <aside class="control-sidebar control-sidebar-dark"></aside>

</div>

<script src="{{asset("js/app.js")}}"></script>
<script>
    @if(env("APP_DEBUG"))
    console.log({!! json_encode(DB::getQueryLog()) !!});
    @endif
    $(document).ready(function () {
        const msg = "{{session()->has("msg")}}";
        const error = "{{session()->has("error")}}";
        if (msg !== "") {
            setTimeout(function () {
                Swal.fire({
                    title: 'موفق!',
                    html: '{!! session()->get("msg")  !!}',
                    icon: 'success',
                    confirmButtonText: 'بستن'
                })
            }, 250);
        }
        if (error !== "") {
            setTimeout(function () {
                Swal.fire({
                    title: '‌خطا!',
                    html: '{!! session()->get("error")  !!}',
                    icon: 'error',
                    confirmButtonText: 'بستن'
                })
            }, 250);
        }
    })
</script>
@yield("ex-js")
</body>
</html>
