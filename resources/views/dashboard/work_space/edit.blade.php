@extends('layouts.panel.master')

@section("ex-title","ویرایش فضای کاری")

@section("content")
    <form action="{{route('work_space.update',$workSpace->id)}}" method="post" class="grid grid-cols-2 gap-2">
        @method('put')
        @csrf
        <label>
            عنوان
            <input type="text" name="{{\App\Models\WorkSpace::TITLE}}" value="{{old(\App\Models\WorkSpace::TITLE,$workSpace->title)}}">
        </label>

        <label>
            قیمت
            <input type="text" name="{{\App\Models\WorkSpace::PRICE}}" value="{{old(\App\Models\WorkSpace::PRICE,$workSpace->price)}}">
        </label>

        <button class="btn-success">
            ویرایش
        </button>
    </form>
@endsection