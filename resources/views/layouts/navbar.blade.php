<header class="header-section">
    <div class="header-warp">
        <div class="header-social d-flex justify-content-end">
            <p>Follow me:</p>
            <social></social>
        </div>
        <div class="header-bar-warp d-flex">
            <!-- site logo -->
            <div class="user-panel w-25 d-none d-md-block">
                @auth
                    <a href="{{route("login")}}">Dashboard</a>
                @endauth
                @guest
                    <a href="{{route("login")}}">Login</a>
                    @if (Route::has('register'))
                        / <a href="{{route("register")}}">Register
                            @endif
                        </a>
                @endguest
            </div>
            <div class="user-panel w-25 d-block d-md-none">
                <a href="{{route("login")}}" title="login">
                    <i class="fa fa-user"></i>
                </a>
            </div>
            <nav class="top-nav-area w-100">
                <a href="{{route("blog")}}" class="site-logo p-1 mx-auto">
                    <h1 class="text-white p-0">{{env("APP_NAME")}}</h1>
                </a>
                <!--Menu -->
                <ul id="menu" class="main-menu primary-menu rtl">
                    <li><a class="text-center" href="{{route("blog")}}">خانه</a></li>
                    {{--<li><a class="text-center" href="games.html">بازی</a><ul class="sub-menu"><li><a class="text-center" href="game-single.html">بازی ۱</a></li></ul></li>--}}
                    <li><a class="text-center" href="review.html">نظرات</a></li>
                    <li><a class="text-center" href="blog.html">اخبار</a></li>
                    <li><a class="text-center" href="contact.html">تماس با ما</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
