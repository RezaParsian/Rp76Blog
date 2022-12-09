@extends("layouts.dashboard.index")

@section("ex-title","ویرایش کاربر ".$user->name)

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{route("crm.update",$user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("put")

                <div class="form-group row">
                    <div class="col-md">
                        <label for="{{\App\Models\User::NAME}}">نام و نام‌خانوادگی</label>
                        <input type="text" class="form-control" required value="{{old(\App\Models\User::NAME,$user->name)}}" name="{{\App\Models\User::NAME}}" id="{{\App\Models\User::NAME}}">
                    </div>
                    <div class="col-md">
                        <label for="{{\App\Models\User::EMAIL}}">ایمیل</label>
                        <input type="text" class="form-control" required value="{{old(\App\Models\User::EMAIL,$user->email)}}" name="{{\App\Models\User::EMAIL}}" id="{{\App\Models\User::EMAIL}}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label for="{{\App\Models\User::PASSWORD}}">رمزعبور</label>
                        <input type="password" autocomplete="off" class="form-control" name="{{\App\Models\User::PASSWORD}}" id="{{\App\Models\User::PASSWORD}}">
                    </div>
                    <div class="col-md">
                        <label for="{{\App\Models\User::ROLE_ID}}">مقام</label>
                        <select name="{{\App\Models\User::ROLE_ID}}" id="{{\App\Models\User::ROLE_ID}}" class="form-control">
                            @foreach(\App\Models\Role::all() as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success rounded">
                        <i class="fa fa-floppy-o"></i>
                        ذخیره
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('ex-js')
<script>
    $("#{{\App\Models\User::ROLE_ID}}").val("{{$user->role_id}}");
</script>
@endsection
