@extends("layouts.dashboard.index")

@section("ex-title","مقالات")

@section("content")
    <div class="card">
        <div class="card-header">
            <a href="{{route("article.create")}}" class="btn btn-outline-success"><i class="fa fa-plus-circle align-self-center mx-1"></i>پست جدید</a>
        </div>
        <div class="card-body">
            <table class="text-center dtTable table table-bordered table-striped table-responsive-md">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>موضوع</th>
                    <th>تاریخ ایجاد</th>
                    <th>تاریخ ویرایش</th>
                    <th>مدیریت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{$article->id}}</td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->created_at_diff}}</td>
                        <td>{{$article->updated_at_diff}}</td>
                        <td>
                            <form action="{{route("article.destroy",$article->id)}}" method="post">
                                <a href="{{route("article.edit",$article->id)}}" class="btn btn-warning rounded-circle">
                                    <i class="fa fa-eye"></i>
                                </a>
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
@endsection

@section("ex-js")
    <script>
        function verify(element) {
            Swal.fire({
                title: 'آیا از مقاله این محصول مطمئن هستید؟',
                showCancelButton: true,
                input:"text",
                cancelButtonText: "خیر",
                confirmButtonText: `بله`,
            }).then((result) => {
                if (result.isConfirmed && result.value==="confirm") {

                    Swal.fire({
                        icon: "success",
                        showCancelButton: false,
                        showConfirmButton: false
                    });

                    setTimeout(function () {
                        $(element).parent().submit();
                    }, 700);
                }
                return false;
            })
        }

        $(function () {
            table1 = $('.dtTable').DataTable({
                responsive: true,
                language: {
                    "sEmptyTable": "هیچ داده ای در جدول وجود ندارد",
                    "sInfo": "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                    "sInfoEmpty": "نمایش 0 تا 0 از 0 رکورد",
                    "sInfoFiltered": "(فیلتر شده از _MAX_ رکورد)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ",",
                    "sLengthMenu": "نمایش _MENU_ رکورد",
                    "sLoadingRecords": "در حال بارگزاری...",
                    "sProcessing": "در حال پردازش...",
                    "sSearch": "جستجو:",
                    "sZeroRecords": "رکوردی با این مشخصات پیدا نشد",
                    "oPaginate": {
                        "sFirst": "ابتدا",
                        "sLast": "انتها",
                        "sNext": "بعدی",
                        "sPrevious": "قبلی"
                    },
                    "oAria": {
                        "sSortAscending": ": فعال سازی نمایش به صورت صعودی",
                        "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
                    }
                }
            });
            $('select[aria-controls=\'DataTables_Table_0\']').addClass("form-control mx-2");
            $("select[aria-controls='DataTables_Table_0']").parent().addClass("form-inline");
            $('input[aria-controls=\'DataTables_Table_0\']').addClass("form-control mx-2");
            $("input[aria-controls='DataTables_Table_0']").parent().addClass("form-inline");
            table1.order([0, "desc"]).draw();
        });
    </script>
@endsection
