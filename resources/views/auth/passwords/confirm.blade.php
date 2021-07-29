@extends('layouts.app')

@section("ex-title")
    فرم زیر را تکمیل کنید و <strong>تایید رمزعبور</strong> بزنید
@endsection

@section('content')
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group row">
            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="رمزعبور">
                <div class="input-group-append">
                    <span class="fa fa-envelope input-group-text"></span>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <button type="submit" class="btn rounded btn-primary">تایید رمزعبور</button>
            </div>
        </div>
    </form>

    <hr class="bg-gray-light mx-5">

    <div class="row justify-content-center">
        <a href="{{route("login")}}">ورود</a>
        <label class="mx-2">|</label>
        <a href="{{route("register")}}">ثبت نام</a>
    </div>
@endsection
