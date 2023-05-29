@extends('layouts.panel.master')

@section("ex-title","فضای کاری جدید")

@section("content")
    <form action="{{route('work_space.store')}}" method="post" class="grid grid-cols-2 gap-2">
        @csrf
        <label>
            عنوان
            <input type="text" name="{{\App\Models\WorkSpace::TITLE}}" value="{{old(\App\Models\WorkSpace::TITLE)}}">
        </label>

        <label>
            قیمت
            <input type="text" name="{{\App\Models\WorkSpace::PRICE}}" value="{{old(\App\Models\WorkSpace::PRICE)}}">
        </label>

        <button class="btn-success">
            ثبت
        </button>
    </form>
@endsection