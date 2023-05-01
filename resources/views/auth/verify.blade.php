@extends('auth.master')

@section("title","تایید آدرس ایمیل")

@section('body')
    <div class="grid gap-4">
        {{--    @if (session('resent'))--}}
        <div class="text-green-500 bg-green-100 p-3 rounded-lg">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
        {{--    @endif--}}

        {{ __('Before proceeding, please check your email for a verification link.') }}

        <p class="mt-2">
            {{ __('If you did not receive the email') }}
        </p>
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="bg-rp-500 hover:bg-rp-700 w-full rounded-xl text-white font-bold py-2 px-10 rounded">
                {{ __('click here to request another') }}
            </button>
        </form>
    </div>
@endsection
