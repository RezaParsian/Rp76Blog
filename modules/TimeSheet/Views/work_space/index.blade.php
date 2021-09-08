@extends("layouts.dashboard.index")

@section("ex-title","فضا های کاری")

@section("content")
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close mx-0" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="$('#submit').click()">ثبت</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <button class="btn btn-outline-success" id="make"><i class="fa fa-plus-circle align-self-center mx-1"></i>فضای کاری جدید</button>
        </div>
        <div class="card-body">
            <table class="text-center dtTable table table-bordered table-striped table-responsive-md">
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
                        <td>{{$workSpace->price}}</td>
                        <td>
                            <form action="{{route("work_space.destroy",$workSpace->id)}}" method="post">
                                <button class="btn btn-warning rounded-circle btnEdit" type="button" data-update="{{route("work_space.update",$workSpace->id)}}" data-view="{{route("work_space.show",$workSpace->id)}}">
                                    <i class="fa fa-eye"></i>
                                </button>
                                @csrf
                                @method("delete")
                                <button class="btn btn-danger rounded-circle" type="button" onclick="verify(this)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="input-group clockpicker">
        <input type="text" class="form-control" name="clock">
        <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
    </div>

@endsection

@section("ex-js")
    <script type="text/javascript">
        $('.clockpicker').clockpicker({
            donetext: 'Done',
            placement:"top"
        });

        function convertHourstoMinute(str) {
            let [hours, minutes] = str.split(':');
            return (+hours * 60) + (+minutes);
        }
    </script>

    <script>
        $("#make").click(function () {
            $(".modal-title").text("فضای کاری جدید")
            $(".modal-body").html(`
            <form action="{{route("work_space.store")}}" method="post">
             @csrf
            <div class="form-group">
            <label for="{{\Modules\TimeSheet\Models\WorkSpace::TITLE}}">نام فعالیت</label>
            <input type="text" name="{{\Modules\TimeSheet\Models\WorkSpace::TITLE}}" id="{{\Modules\TimeSheet\Models\WorkSpace::TITLE}}" class="form-control">
            </div>
             <div class="form-group">
            <label for="{{\Modules\TimeSheet\Models\WorkSpace::PRICE}}">قیمت بر ساعت</label>
            <input type="number" step='10000' name="{{\Modules\TimeSheet\Models\WorkSpace::PRICE}}" id="{{\Modules\TimeSheet\Models\WorkSpace::PRICE}}" class="form-control text-center">
            </div>
             <input type="submit" id="submit" class="d-none"> </form>
            `);
            $("#myModal").modal("show");
        })

        $(".btnEdit").click(function () {
            const update = $(this).data("update");
            const view = $(this).data("view");
            $(".modal-body").html(` <form action="${update}" method="post"> @csrf @method("put")  <div class="form-group">
            <label for="{{\Modules\TimeSheet\Models\WorkSpace::TITLE}}">نام فعالیت</label>
            <input type="text" name="{{\Modules\TimeSheet\Models\WorkSpace::TITLE}}" id="{{\Modules\TimeSheet\Models\WorkSpace::TITLE}}" class="form-control">
            </div>
             <div class="form-group">
            <label for="{{\Modules\TimeSheet\Models\WorkSpace::PRICE}}">قیمت بر ساعت</label>
            <input type="number" step='10000' name="{{\Modules\TimeSheet\Models\WorkSpace::PRICE}}" id="{{\Modules\TimeSheet\Models\WorkSpace::PRICE}}" class="form-control text-center">
            </div> <input type="submit" id="submit" class="d-none"> </form>`)

            $.get(view, function (data) {
                $("#{{\Modules\TimeSheet\Models\WorkSpace::TITLE}}").val(data.title);
                $("#{{\Modules\TimeSheet\Models\WorkSpace::PRICE}}").val(data.price);
            });

            $(".modal-title").text("ویرایش فضای کاری")
            $("#myModal").modal("show");
        });
    </script>
@endsection
