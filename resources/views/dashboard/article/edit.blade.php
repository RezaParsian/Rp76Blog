@extends('layouts.panel.master')

@section("ex-title","مقالات")

@section('content')
    <form action="{{route('article.update',$article->id)}}" method="post" enctype="multipart/form-data" class="grid grid-cols-2 gap-2">
        @method('put')
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

        <label>
            عکس مقاله
            <input type="file" name="image">
        </label>

        <label class="col-span-2 mt-3">
            <textarea name="content" id="content" cols="30" rows="10">{{old('content',$article->content)}}</textarea>
        </label>

        <button class="btn-success">
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
