@extends('layouts.app')

@section("ex-title")
    فرم زیر را تکمیل کنید و <strong>بازیابی رمز عبور</strong> بزنید
@endsection

@section('content')
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <div class="input-group mb-3">
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="ایمیل" value="{{ old('email') }}" required="" autocomplete="email" autofocus>
                <div class="input-group-append">
                    <span class="fa fa-envelope input-group-text"></span>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="row mx-auto">
            <button type="submit" class="btn btn-primary">
                بازیابی رمز عبور
            </button>
        </div>
    </form>

    <hr class="bg-gray-light mx-5">

    <div class="row justify-content-center">
        <a href="{{route("login")}}">ورود</a>
        <label class="mx-2">|</label>
        <a href="{{route("register")}}">ثبت نام</a>
    </div>
@endsection
