@extends("layouts.dashboard.index")

@section("ex-title","دسته بندی ها")

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
            <button class="btn btn-outline-success" id="make"><i class="fa fa-plus-circle align-self-center mx-1"></i>دسته جدید</button>
        </div>
        <div class="card-body">
            <table class="text-center dtTable table table-bordered table-striped table-responsive-md">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>موضوع</th>
                    <th>Slug</th>
                    <th>تاریخ ایجاد</th>
                    <th>مدیریت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->title}}</td>
                        <td>{{$category->slug}}</td>
                        <td>{{$category->created_at_diff}}</td>
                        <td>
                            <form action="{{route("category.destroy",$category->id)}}" method="post">
                                <button class="btn btn-warning rounded-circle btnEdit" type="button" data-update="{{route("category.update",$category->id)}}" data-view="{{route("category.show",$category->id)}}">
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
@endsection

@section("ex-js")
    <script>
        function verify(element) {
            Swal.fire({
                title: 'آیا از مقاله این دسته مطمئن هستید؟',
                showCancelButton: true,
                input: "text",
                cancelButtonText: "خیر",
                confirmButtonText: `بله`,
            }).then((result) => {
                if (result.isConfirmed && result.value === "confirm") {

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

        $("#make").click(function () {
            $(".modal-title").text("دسته جدید")
            $(".modal-body").html(` <form action="{{route("category.store")}}" method="post"> @csrf <div class="form-group"> <label for="{{\App\Models\Category::TITLE}}">موضوع</label> <input type="text" class="form-control" required name="{{\App\Models\Category::TITLE}}" id="{{\App\Models\Category::TITLE}}"> </div> <div class="form-group"> <label for="{{\App\Models\Category::SLUG}}">Slug</label> <input type="text" class="form-control" required name="{{\App\Models\Category::SLUG}}" id="{{\App\Models\Category::SLUG}}"> </div> <div class="form-group"> <label for="{{\App\Models\Category::TYPE}}">نوع</label> <select name="{{\App\Models\Category::TYPE}}" id="{{\App\Models\Category::TYPE}}" class="form-control"> <option value="">یک نوع انتخاب کنید</option> </select> </div> <div class="form-group"> <label for="{{\App\Models\Category::PARENT_ID}}">دسته بندی والد</label> <select name="{{\App\Models\Category::PARENT_ID}}" id="{{\App\Models\Category::PARENT_ID}}" class="form-control"> <option value="0">یک والد انتخاب کنید</option> @foreach($categories as $category) <option value="{{$category->id}}">{{$category->title}}</option> @endforeach </select> </div> <input type="submit" id="submit" hidden> </form>`);
            $("#myModal").modal("show");
        })

        $(".btnEdit").click(function () {
            const update = $(this).data("update");
            const view = $(this).data("view");
            $(".modal-body").html(`<form action="${update}" method="post"> @csrf @method("put") <div class="form-group"> <label for="{{\App\Models\Category::TITLE}}">موضوع</label> <input type="text" class="form-control" required name="{{\App\Models\Category::TITLE}}" id="{{\App\Models\Category::TITLE}}"> </div> <div class="form-group"> <label for="{{\App\Models\Category::SLUG}}">Slug</label> <input type="text" class="form-control" required name="{{\App\Models\Category::SLUG}}" id="{{\App\Models\Category::SLUG}}"></div> <div class="form-group"> <label for="{{\App\Models\Category::TYPE}}">نوع</label> <select name="{{\App\Models\Category::TYPE}}" id="{{\App\Models\Category::TYPE}}" class="form-control"> <option value="">یک نوع انتخاب کنید</option> </select> </div> <div class="form-group"> <label for="{{\App\Models\Category::PARENT_ID}}">دسته بندی والد</label> <select name="{{\App\Models\Category::PARENT_ID}}" id="{{\App\Models\Category::PARENT_ID}}" class="form-control"> <option value="0">یک والد انتخاب کنید</option> @foreach($categories as $category) <option value="{{$category->id}}">{{$category->title}}</option> @endforeach </select> </div> <input type="submit" id="submit" hidden> </form>`)

            $.get(view,function (data){
                $("#{{\App\Models\Category::TITLE}}").val(data.title);
                $("#{{\App\Models\Category::SLUG}}").val(data.slug);
                $("#{{\App\Models\Category::TYPE}}").val(data.type);
                $("#{{\App\Models\Category::PARENT_ID}}").val(data.parent_id);
            });

            $("#myModal").modal("show");
        });
    </script>
@endsection
