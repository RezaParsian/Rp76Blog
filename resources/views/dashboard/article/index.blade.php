@extends('layouts.panel.master')

@section("ex-title","مقالات")

@section('content')
    <a href="{{route('article.create')}}" class="rounded px-8 py-1 border bg-green-300 hover:bg-green-400 text-green-700 border-green-500">+جدید</a>

    <div class="overflow-auto">
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
                    <td>{{$article->id}}</td>
                    <td>{{$article->title}}</td>
                    <td>{{@$article->category->title}}</td>
                    <td dir="ltr">{{$article->updated_at}}</td>
                    <td>
                        <form method="post" action="{{route('article.destroy',$article->id)}}">
                            @csrf
                            @method('delete')
                            <a class="rounded px-8 py-1 border bg-green-300 hover:bg-green-400 text-green-700 border-green-500" href="{{route('article.edit',$article->id)}}">ویرایش</a>
                            <button class="rounded px-8 py-1 border bg-red-300 hover:bg-red-400 text-red-700 border-red-500">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div dir="ltr">
        {{$articles->links('layouts.paginate')}}
    </div>
@endsection
