@extends('auth.master')

@section("title",'ثبت‌نام')

@section('body')
    <form method="POST" action="{{ route('register') }}" class="grid gap-3">
        @csrf
        <div class="input-group mb-3">
            <input placeholder="نام و نام خانوادگی" id="name" type="text" class="form-control @error('name') border-red-400 border-2  @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            <div class="input-group-append">
                <span class="fa fa-user input-group-text"></span>
            </div>
            @error('name')
            <span class="text-red-500 text-xs" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input placeholder="ایمیل" id="email" type="email" class="form-control @error('email') border-red-400 border-2  @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            <div class="input-group-append"><span class="fa fa-envelope input-group-text"></span></div>
            @error('email')
            <span class="text-red-500 text-xs" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input placeholder="رمز عبور" id="password" type="password" class="form-control @error('password') border-red-400 border-2  @enderror" name="password" required autocomplete="new-password">
            <div class="input-group-append">
                <span class="fa fa-lock input-group-text"></span>
            </div>
            @error('password')
            <span class="text-red-500 text-xs" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input placeholder="تکرار رمز عبور" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            <div class="input-group-append">
                <span class="fa fa-lock input-group-text"></span>
            </div>
        </div>

        <button type="submit" class="bg-rp-500 hover:bg-rp-700 w-full rounded-xl text-white font-bold py-2 px-10 rounded">
            ثبت نام
        </button>
    </form>


    <div class="justify-center border-t flex mt-2 pt-4">
        <a href="{{route("login")}}">ورود</a>
        <label class="mx-2">|</label>
        <a href="{{route("password.request")}}">فراموشی رمز عبور</a>
    </div>
@endsection
