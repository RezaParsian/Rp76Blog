@extends('auth.master')

@section('title','تایید رمزعبور')

@section('body')
    <form method="POST" action="{{ route('password.confirm') }}" class="grid gap-3">
        @csrf

        <div class="form-group row">
            <div class="input-group mb-3">
                <input id="password" type="password" class="@error('password') text-red-500 text-xs @enderror" name="password" required autocomplete="current-password" placeholder="رمزعبور">

                @error('password')
                <span class="text-red-500 text-xs">
                        <strong>{{ __($message) }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <button type="submit" class="bg-rp-500 hover:bg-rp-700 w-full rounded-xl text-white font-bold py-2 px-10 rounded">
            تایید رمزعبور
        </button>
    </form>
@endsection
