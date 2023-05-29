@extends('layouts.panel.master')

@section("ex-title","مقالات")

@section('content')
    <form action="{{route('article.store')}}" method="post" enctype="multipart/form-data" class="grid grid-cols-2 gap-2">
        @csrf
        <label>
            عنوان
            <input type="text" name="title" value="{{old('title')}}">
        </label>

        <label>
            نامک
            <input type="text" name="slug" value="{{old('slug')}}">
        </label>

        <label>
            نوع پست
            <select name="type">
                <option value="blog">پست بلند</option>
                <option value="twit">پست کوتاه</option>
            </select>
        </label>

        <label>
            دسته‌بندی
            <select name="category_id">
                <option value="">یک دسته‌بندی انتخاب فرمایید.</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </label>

        <label>
            تگ‌ها
            <select name="tags[]" multiple>
                <option value="">یک دسته‌بندی انتخاب فرمایید.</option>
                @foreach($tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->title}}</option>
                @endforeach
            </select>
        </label>

        <label>
            عکس مقاله
            <input type="file" name="image">
        </label>

        <label class="col-span-2">
            <textarea name="content" id="content" cols="30" rows="10">{{old('content')}}</textarea>
        </label>

        <button class="btn-success">
            ثبت
        </button>
    </form>
@endsection
