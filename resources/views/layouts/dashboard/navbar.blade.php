<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>
    {{--    <form class="form-inline ml-3"><div class="input-group input-group-sm"><input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search"><div class="input-group-append"><button class="btn btn-navbar" type="submit"><i class="fa fa-search"></i></button></div></div></form>--}}
    <ul class="navbar-nav mr-auto">
        @if(session()->has("user_id"))
            <li class="nav-item">
                <form action="{{route("crm.switch.user")}}" method="post">
                    @csrf
                    <button class="btn">
                        <i class="fa fa-key"></i>
                    </button>
                </form>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fa fa-th-large"></i></a>
        </li>
        <li class="nav-item">
            <form action="{{route("logout")}}" method="post">
                @csrf
                <button class="btn">
                    <i class="fa fa-power-off"></i>
                </button>
            </form>
        </li>
    </ul>
</nav>
