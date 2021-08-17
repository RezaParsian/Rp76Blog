@extends("layouts.dashboard.index")

@section("ex-title","تگ ها")

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
                    <form action="{{route("tag.store")}}" method="post">
                        @csrf
                        @method("put")
                        <div class="form-group">
                            <label for="{{\App\Models\Tag::TITLE}}">موضوع</label>
                            <input type="text" name="{{\App\Models\Tag::TITLE}}" id="{{\App\Models\Tag::TITLE}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="{{\App\Models\Tag::SLUG}}">نامک</label>
                            <input type="text" name="{{\App\Models\Tag::SLUG}}" id="{{\App\Models\Tag::SLUG}}" class="form-control">
                        </div>
                    </form>
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
            <button class="btn btn-outline-success" id="make"><i class="fa fa-plus-circle align-self-center mx-1"></i>تگ جدید</button>
        </div>
        <div class="card-body">
            {{$tags->appends(Request()->all())->links("pagination::bootstrap-4")}}

            <table class="text-center table table-bordered table-striped table-responsive-md">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>موضوع</th>
                    <th>Slug</th>
                    <th>مدیریت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td>{{$tag->id}}</td>
                        <td>{{$tag->title}}</td>
                        <td>{{$tag->slug}}</td>
                        <td>
                            <form action="{{route("tag.destroy",$tag->id)}}" method="post">
                                <button class="btn btn-warning rounded-circle btnEdit" type="button" data-update="{{route("tag.update",$tag->id)}}" data-view="{{route("tag.show",$tag->id)}}">
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
            {{$tags->appends(Request()->all())->links("pagination::bootstrap-4")}}
        </div>
    </div>
@endsection

@section("ex-js")
    <script>
        function verify(element) {
            Swal.fire({
                title: 'آیا از تگ این تگ مطمئن هستید؟',
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
            $(".modal-title").text("تگ جدید")
            $(".modal-body").html(`<form action="{{route("tag.store")}}" method="post"> @csrf <div class="form-group"> <label for="{{\App\Models\Tag::TITLE}}">موضوع</label> <input type="text" name="{{\App\Models\Tag::TITLE}}" id="{{\App\Models\Tag::TITLE}}" class="form-control"> </div> <div class="form-group"> <label for="{{\App\Models\Tag::SLUG}}">نامک</label> <input type="text" name="{{\App\Models\Tag::SLUG}}" id="{{\App\Models\Tag::SLUG}}" class="form-control"> </div> </form>`);
            $("#myModal").modal("show");
        })

        $(".btnEdit").click(function () {
            const update = $(this).data("update");
            const view = $(this).data("view");
            // $(".modal-body").html(``)

            $.get(view, function (data) {
                $("#{{\App\Models\Category::TITLE}}").val(data.title);
                $("#{{\App\Models\Category::SLUG}}").val(data.slug);
                $("#{{\App\Models\Category::TYPE}}").val(data.type);
                $("#{{\App\Models\Category::PARENT_ID}}").val(data.parent_id);
            });

            $("#myModal").modal("show");
        });
    </script>
@endsection
