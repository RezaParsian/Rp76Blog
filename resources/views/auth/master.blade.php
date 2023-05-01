@extends('layouts.blog.master')

@section('content')
    <div class="flex">
        <div class="mx-auto w-full rounded-3xl md:w-1/2 p-8 pb-4 side-card">
            <h2 class="mb-5 header">@yield('title')</h2>
            @yield('body')
        </div>
    </div>
@endsection
