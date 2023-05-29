@extends('layouts.panel.master')

@section("ex-title","مقالات")

@section('content')
    <a href="{{route('article.create')}}" class="btn-success">+جدید</a>

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
                            <a class="btn-success" href="{{route('article.edit',$article->id)}}">ویرایش</a>
                            <button class="btn-danger">حذف</button>
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
