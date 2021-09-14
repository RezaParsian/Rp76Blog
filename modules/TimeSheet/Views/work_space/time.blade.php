@extends("layouts.dashboard.index")

@section("ex-title","فضا های کاری")

@section("content")
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ساعت کاری جدید</h4>
                    <button type="button" class="close mx-0" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route("time_sheet.store")}}" method="post">
                        @csrf
                        <input type="hidden" name="{{\Modules\TimeSheet\Models\TimeSheet::WORK_SPACE_ID}}" value="{{$workSpace->id}}">

                        <div class="form-group">
                            <label for="{{\Modules\TimeSheet\Models\TimeSheet::WORK_TIME}}">ساعت کاری</label>
                            <div class="input-group clockpicker">
                                <input type="text" class="form-control" name="{{\Modules\TimeSheet\Models\TimeSheet::WORK_TIME}}">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>

                        <input type="submit" id="submit" class="d-none"></form>
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
            <button class="btn btn-outline-success" id="make"><i class="fa fa-plus-circle align-self-center mx-1"></i>ساعت کاری جدید</button>
            <button class="btn btn-outline-secondary float-left" id="export" title="خرجی از اول تا آخر ماه" data-toggle="tooltip"><i class="fa fa-download mx-1"></i>خروجی</button>
            <input type="number" id="month" class="form-control float-left col-1 mx-2" value="1">
        </div>
        <div class="card-body">
            <table class="text-center dtTable table table-bordered table-striped table-responsive-md">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>زمان</th>
                    <th>قیمت بر ساعت</th>
                    <th>تاریخ ثبت</th>
                    <th>مدیریت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($workSpace->timeSheet as $key=>$timeSheet)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{number_format($timeSheet->work_time)}} دقیقه</td>
                        <td>{{number_format($timeSheet->price)}} ﷼</td>
                        <td data-toggle="tooltip" title="{{$timeSheet->created_at_p}}">{{$timeSheet->created_at_diff}}</td>
                        <td>
                            <form action="{{route("time_sheet.destroy",$timeSheet->id)}}" method="post">
                                @csrf
                                @method("delete")
                                <button class="btn btn-danger rounded-circle" type="button" onclick="verify(this)" title="حذف فضای کاری" data-toggle="tooltip">
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
@endsection

@section("ex-js")
    <script>
        $("#make").click(function () {
            $("#myModal").modal("show");
        });

        $("#export").click(function () {
            window.location.href="{{route("time_sheet.export",$workSpace->id)}}?month="+$("#month").val();
        });

        $(function () {
            $('.clockpicker').clockpicker({
                donetext: 'انتخاب',
                placement: "left"
            });
        })

        function convertHourstoMinute(str) {
            let [hours, minutes] = str.split(':');
            return (+hours * 60) + (+minutes);
        }

    </script>
@endsection
