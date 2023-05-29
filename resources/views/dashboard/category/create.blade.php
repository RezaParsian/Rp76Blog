@extends('layouts.panel.master')

@section("ex-title","مقالات")

@section('content')
    <form action="{{route('category.store')}}" method="post" class="grid grid-cols-2 gap-2">
        @csrf
        <label>
            عنوان
            <input type="text" name="title">
        </label>

        <label>
            نامک
            <input type="text" name="slug">
        </label>

        <label>
            دسته‌بندی
            <select name="parent_id">
                <option value="">یک دسته‌بندی انتخاب فرمایید.</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </label>

        <div></div>

        <button class="btn-success">
            ثبت
        </button>
    </form>
@endsection
