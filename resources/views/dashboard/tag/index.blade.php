@extends('layouts.panel.master')

@section("ex-title","تگ")

@section('content')
    <a href="{{route('tag.create')}}" class="rounded px-8 py-1 border bg-green-300 hover:bg-green-400 text-green-700 border-green-500">+جدید</a>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th class="w-1/2">عنوان</th>
            <th>مدیریت</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{{$tag->id}}</td>
                <td>
                    <p class="truncate">
                        {{$tag->title}}
                    </p>
                </td>
                <td>
                    <form method="post" action="{{route('tag.destroy',$tag->id)}}">
                        @csrf
                        @method('delete')
                        <button class="rounded px-8 py-1 border bg-red-300 hover:bg-red-400 text-red-700 border-red-500">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div dir="ltr">
        {{$tags->links('layouts.paginate')}}
    </div>
@endsection
