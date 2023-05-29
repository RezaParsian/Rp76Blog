@extends('auth.master')

@section('title','بازیابی رمز عبور')

@section('body')
    <form method="POST" action="{{ route('password.email') }}" class="grid gap-3">
        @csrf

        <div class="form-group">
            <div class="input-group mb-3">
                <input type="email" id="email" name="email" class="form-control @error('email') border-red-400 border-2   @enderror" placeholder="ایمیل" value="{{ old('email') }}" required="" autocomplete="email" autofocus>

                @error('email')
                <span class="text-red-500 text-xs"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <button type="submit" class="bg-rp-500 hover:bg-rp-700 w-full rounded-xl text-white font-bold py-2 px-10 rounded">
            بازیابی رمز عبور
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
