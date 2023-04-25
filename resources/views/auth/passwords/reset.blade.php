@extends('auth.master')

@section('title','بازیابی رمز عبور')

@section('body')
    <form method="POST" action="{{ route('password.update') }}" class="grid gap-3">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group row">
            <div class="input-group mb-3">
                <input id="email" type="email" class="form-control @error('email') text-red-500 text-xs @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="ایمیل">

                @error('email')
                <span class="text-red-500 text-xs"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') text-red-500 text-xs @enderror" name="password" required autocomplete="new-password" placeholder="رمزعبود">

                @error('password')
                <span class="text-red-500 text-xs"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="input-group mb-3">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="تایید رمزعبور">

                @error('password')
                <span class=""><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <button type="submit" class="bg-rp-500 hover:bg-rp-700 w-full rounded-xl text-white font-bold py-2 px-10 rounded"> تغیر رمزعبور
        </button>
    </form>

    <div class="justify-center border-t flex mt-2 pt-4">
        <a href="{{route("login")}}">ورود</a>
        @if (Route::has('register'))
            <label class="mx-2">|</label>
            <a href="{{route("register")}}">ثبت نام</a>
        @endif
    </div>
@endsection
