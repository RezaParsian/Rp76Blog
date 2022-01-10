@extends('layouts.app')

@section("ex-title","فرم زیر را تکمیل کنید و ورود بزنید")

@section('content')

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group mb-3">
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="ایمیل" value="{{ old('email') }}" required autocomplete="email" autofocus>
            <div class="input-group-append">
                <span class="fa fa-envelope input-group-text"></span>
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="رمز عبور">
            <div class="input-group-append">
                <span class="fa fa-lock input-group-text"></span>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="row">
            <div class="col-4">
                <button type="submit" class="btn rounded btn-primary btn-block btn-flat">ورود</button>
            </div>
        </div>
    </form>

    <hr class="bg-gray-light mx-5">
   <div class="row justify-content-center">
       @if (Route::has('register'))
       <a href="{{route("register")}}">ثبت نام</a>
           <label class="mx-2">|</label>
       @endif
       <a href="{{route("password.request")}}">فراموشی رمز عبور</a>
   </div>

@endsection
