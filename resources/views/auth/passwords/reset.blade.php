@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group row">
            <div class="input-group mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="ایمیل">
                <div class="input-group-append">
                    <span class="fa fa-envelope input-group-text"></span>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="رمزعبود">
                <div class="input-group-append">
                    <span class="fa fa-lock input-group-text"></span>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="input-group mb-3">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="تایید رمزعبور">
                <div class="input-group-append">
                    <span class="fa fa-lock input-group-text"></span>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <button type="submit" class="btn rounded btn-primary">تغیر رمزعبور</button>
            </div>
        </div>
    </form>

    <hr class="bg-gray-light mx-5">
    <div class="row justify-content-center">
        <a href="{{route("login")}}">ورود</a>
        @if (Route::has('register'))
            <label class="mx-2">|</label>
            <a href="{{route("register")}}">ثبت نام</a>
        @endif
    </div>
@endsection
