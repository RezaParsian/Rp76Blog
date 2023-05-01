@extends('layouts.panel.master')

@section("ex-title","مقالات")

@section('content')
    <form action="{{route('tag.store')}}" method="post" enctype="multipart/form-data" class="grid grid-cols-2 gap-2">
        @csrf
        <label>
            عنوان
            <input type="text" name="title">
        </label>

        <label>
            نامک
            <input type="text" name="slug">
        </label>

        <button class="rounded px-8 py-1 border bg-green-300 hover:bg-green-400 text-green-700 border-green-500">
            ثبت
        </button>
    </form>
@endsection
