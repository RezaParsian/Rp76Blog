@extends('layouts.panel.master')

@section("ex-title","مقالات")

@section('content')
    <form action="{{route('article.update',$article->id)}}" method="post" enctype="multipart/form-data" class="grid grid-cols-2 gap-2">
        @csrf
        <label>
            عنوان
            <input type="text" name="title" value="{{old('title',$article->title)}}">
        </label>

        <label>
            نامک
            <input type="text" name="slug" value="{{old('slug',$article->slug)}}">
        </label>

        <label>
            دسته‌بندی
            <select name="category_id" id="category_id">
                <option value="">یک دسته‌بندی انتخاب فرمایید.</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </label>

        <label class="col-span-2">
            <textarea name="content" id="content" cols="30" rows="10">{{old('content',$article->content)}}</textarea>
        </label>

        <button class="rounded px-8 py-1 border bg-green-300 hover:bg-green-400 text-green-700 border-green-500">
            ویرایش
        </button>
    </form>
@endsection

@section('script')
<script>
    $(() => {
        $('#category_id').val({{$article->category_id}});
    });
</script>
@endsection
