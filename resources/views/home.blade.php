@extends('layouts.panel.master')

@section("ex-title","داشبورد")

@section('content')
    @php
        $quote=\App\Http\Classes\PersianQuote::random();
    @endphp

    <div class="border p-4 rounded dark:text-white">
        <h3>سخن لحظه 🤪</h3>

        <p>{{$quote['body']}}</p>

        <p class="text-left text-sm">{{$quote['author']}}</p>
    </div>
@endsection
