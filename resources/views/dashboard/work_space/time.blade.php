@extends('layouts.panel.master')

@section("ex-title","ساعت های کاری")

@push('aside')
    <div class="side-card my-6 p-4">
        <h3 class="header">ساعت کاری جدید</h3>

        <form action="{{route("time_sheet.store")}}" method="post">
            @csrf
            <input type="hidden" name="{{\App\Models\TimeSheet::WORK_SPACE_ID}}" value="{{$workSpace->id}}">

            <label for="{{\App\Models\TimeSheet::WORK_TIME}}">
                ساعت کاری
                <input dir="ltr" type="text" class="text-center" name="{{\App\Models\TimeSheet::WORK_TIME}}" placeholder="00:00">
            </label>

            <label for="{{\App\Models\TimeSheet::DESCRIPTION}}">
                توضیحات
                <small class="text-muted">(اختیاری)</small>

                <textarea class="form-control" name="{{\App\Models\TimeSheet::DESCRIPTION}}"></textarea>
            </label>

            <button class="mt-5 rounded px-8 py-1 border bg-green-300 hover:bg-green-400 text-green-700 border-green-500 float-left">
                ثبت
            </button>
        </form>
    </div>
@endpush

@section("content")

    <form>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <label for="from">
                از تاریخ
                <input dir="ltr" class="text-center" type="text" name="from" value="{{explode(" ",$fromDate)[0]}}">
            </label>

            <label for="from">
                تا تاریخ
                <input dir="ltr" class="text-center" type="text" name="to" value="{{explode(" ",$toDate)[0]}}">
            </label>
        </div>

        <div class="mt-4">
            <button class="btn-success">
                دریافت اطلاعات
            </button>

            <button type="button" class="rounded px-8 py-1 border bg-violet-300 hover:bg-violet-400 text-violet-700 border-violet-500 float-left" id="export" title="خرجی از اول تا آخر تاریخ انتخاب شده" data-toggle="tooltip">
                خروجی
            </button>
        </div>
    </form>

    <hr class="my-4">

    <table>
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
        @foreach($timeSheets as $key=>$timeSheet)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{number_format($timeSheet->work_time)}} دقیقه</td>
                <td>{{number_format($timeSheet->price)}} ﷼</td>
                <td dir="ltr" class="text-center">{{$timeSheet->created_at_p}}</td>
                <td>
                    <form action="{{route("time_sheet.destroy",$timeSheet->id)}}" method="post">
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

@endsection

@section("script")
    <script>

        $("#export").click(function () {
            const query = new URLSearchParams({
                from: $("[name='from']").val(),
                to: $("[name='to']").val()
            });
            window.location.href = "{{route("time_sheet.export",$workSpace->id)}}?" + query.toString();
        });

        function convertHourstoMinute(str) {
            let [hours, minutes] = str.split(':');
            return (+hours * 60) + (+minutes);
        }

    </script>
@endsection
