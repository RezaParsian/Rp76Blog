@extends('layouts.app')

@section("ex-title")
    فرم زیر را تکمیل کنید و <strong class="text-blog">ثبت</strong> بزنید
@endsection

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="input-group mb-3">
            <input placeholder="نام و نام خانوادگی" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            <div class="input-group-append">
                <span class="fa fa-user input-group-text"></span>
            </div>
            @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input placeholder="ایمیل" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            <div class="input-group-append"><span class="fa fa-envelope input-group-text"></span></div>
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input placeholder="رمز عبور" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            <div class="input-group-append">
                <span class="fa fa-lock input-group-text"></span>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input placeholder="تکرار رمز عبور" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            <div class="input-group-append">
                <span class="fa fa-lock input-group-text"></span>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <button type="submit" class="btn rounded btn-primary btn-block btn-flat">ثبت نام</button>
            </div>
        </div>
    </form>

    <hr class="bg-gray-light mx-5">

    <div class="row justify-content-center">
        <a href="{{route("login")}}">ورود</a>
        <label class="mx-2">|</label>
        <a href="{{route("password.request")}}">فراموشی رمز عبور</a>
    </div>
@endsection
