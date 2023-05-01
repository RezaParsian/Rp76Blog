@extends('layouts.panel.master')

@section("ex-title","مقالات")

@section('content')
    <a href="{{route('article.create')}}" class="rounded px-8 py-1 border bg-green-300 hover:bg-green-400 text-green-700 border-green-500">+جدید</a>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>عنوان</th>
            <th>دسته‌بندی</th>
            <th>تاریخ ویرایش</th>
            <th>مدیریت</th>
        </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
        <tr>
            <td></td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <div dir="ltr">
        {{$articles->links('layouts.paginate')}}
    </div>
@endsection
