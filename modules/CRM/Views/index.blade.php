@extends("layouts.dashboard.index")

@section("ex-title","کاربران")

@section("content")
    <div class="card">
        <div class="card-header">
            @may("crm.create")
            <button class="btn btn-outline-success" disabled><i class="fa fa-plus-circle align-self-center mx-1"></i>کاربر جدید</button>
            @endmay
        </div>
        <div class="card-body">
            <table class="text-center dtTable table table-bordered table-striped table-responsive-md">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام</th>
                    <th>سطح دسترسی</th>
                    <th>مدیریت</th>
                </tr>
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
                                <button type="submit" class="btn btn-primary rounded-circle" title="تغیر حساب کاربری" data-toggle="tooltip">
                                    <i class="fa fa-key"></i>
                                </button>
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                @endmay
                                @may("crm.edit")
                                <a href="{{route("crm.edit",$user->id)}}" class="btn btn-warning rounded-circle" title="ویرایش کاربر" data-toggle="tooltip">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @endmay
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
