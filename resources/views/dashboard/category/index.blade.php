@extends('layouts.panel.master')

@section("ex-title","دسته‌بندی")

@section('content')
    <a href="{{route('category.create')}}" class="rounded px-8 py-1 border bg-green-300 hover:bg-green-400 text-green-700 border-green-500">+جدید</a>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>والد</th>
            <th>عنوان</th>
            <th>مدیریت</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>
                    <p class="truncate">
                        {{$category->parent_id}}
                    </p>
                </td>
                <td>
                    <p class="truncate">
                        {{$category->title}}
                    </p>
                </td>
                <td>
                    <form method="post" action="{{route('category.destroy',$category->id)}}">
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
        {{$categories->links('layouts.paginate')}}
    </div>
@endsection
