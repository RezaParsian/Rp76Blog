@extends('auth.master')

@section("title","ورود")

@section('body')
    <form method="POST" action="{{ route('login') }}" class="grid gap-3">
        @csrf
        <div class="input-group mb-3">
            <input type="email" id="email" name="email" class="@error('email') border-red-400 border-2 @enderror" placeholder="ایمیل" value="{{ old('email') }}" required autocomplete="email" autofocus>

            <div class="input-group-append">
                <span class="fa fa-envelope input-group-text"></span>
            </div>
            @error('email')
            <span class="text-red-500 text-xs" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input id="password" type="password" class="@error('password') border-red-400 border-2 @enderror" name="password" required autocomplete="current-password" placeholder="رمز عبور">

            <div class="input-group-append">
                <span class="fa fa-lock input-group-text"></span>
            </div>
            @error('password')
            <span class="text-red-500 text-xs" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <button type="submit" class="bg-rp-500 hover:bg-rp-700 w-full rounded-xl text-white font-bold py-2 px-10 rounded">
            ورود
        </button>

    </form>

    <div class="justify-center border-t flex my-2 pt-3">
        @if (Route::has('register'))
            <a href="{{route("register")}}">ثبت نام</a>
            <label class="mx-2">|</label>
        @endif
        <a href="{{route("password.request")}}">فراموشی رمز عبور</a>
    </div>

@endsection
