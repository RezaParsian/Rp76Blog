@extends('layouts.panel.master')

@section("ex-title","کاربران")

@section("content")
    <table>
        <thead>
        <tr>
            <th>ردیف</th>
            <th>نام</th>
            <th>سطح دسترسی</th>
            <th>مدیریت</th>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{__(@$user->role->name)}}</td>
                <td>
                    <form action="{{route('crm.switch.user')}}" method="post">
                        @may("admin")
                        @csrf
                        <button type="submit" class="rounded px-8 py-1 border bg-indigo-300 hover:bg-indigo-400 text-indigo-700 border-indigo-500" title="تغیر حساب کاربری" data-toggle="tooltip">
                            تغییر کاربری
                        </button>
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        @endmay

                        @may("crm.edit")
                        <a href="{{route("crm.edit",$user->id)}}" class="rounded px-8 py-1 border bg-yellow-300 hover:bg-yellow-400 text-yellow-700 border-yellow-500" title="ویرایش کاربر" data-toggle="tooltip">
                            نمایش
                        </a>
                        @endmay
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div dir="ltr">
        {{$users->links('layouts.paginate')}}
    </div>
@endsection
