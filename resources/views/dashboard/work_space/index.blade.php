@extends('layouts.panel.master')

@section("ex-title","فضا های کاری")

@section("content")
    <div class="card">
        <div class="card-header">
            <a href="{{route('work_space.create')}}" class="btn-success">
                فضای کاری جدید
            </a>
        </div>
        <div class="card-body">
            <table>
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>موضوع</th>
                    <th>قیمت بر ساعت</th>
                    <th>مدیریت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($workSpaces as $workSpace)
                    <tr>
                        <td>{{$workSpace->id}}</td>
                        <td>{{$workSpace->title}}</td>
                        <td>
                            {{number_format($workSpace->price)}}
                            <small>﷼</small>
                        </td>
                        <td>
                            <form action="{{route("work_space.destroy",$workSpace->id)}}" method="post">
                                <a href="{{route("work_space.edit",$workSpace->id)}}" class="btn-success" title="اضافه کردن ساعت" data-toggle="tooltip">
                                    کارکرد
                                </a>

                                <a href="{{route("work_space.show",$workSpace->id)}}" class="btn-warning">
                                    ویرایش
                                </a>
                                @csrf
                                @method("delete")
                                <button class="btn-danger" type="button" onclick="verify(this)" title="حذف فضای کاری" data-toggle="tooltip">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
