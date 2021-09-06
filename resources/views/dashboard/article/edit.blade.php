@extends("layouts.dashboard.index")

@section("ex-title","مقاله جدید")

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{route("article.update",$article->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("put")
                <div class="form-group row">
                    <div class="col-md">
                        <label for="{{\App\Models\Article::TITLE}}">موضوع</label>
                        <input type="text" name="{{\App\Models\Article::TITLE}}" id="{{\App\Models\Article::TITLE}}" class="form-control" placeholder="موضوع" required>
                    </div>
                    <div class="col-md">
                        <label for="{{\App\Models\Article::SLUG}}">نامک</label>
                        <input type="text" name="{{\App\Models\Article::SLUG}}" id="{{\App\Models\Article::SLUG}}" class="form-control" placeholder="نامک">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label for="{{\App\Models\Article::TYPE}}">نوع پست</label>
                        <select name="{{\App\Models\Article::TYPE}}" id="{{\App\Models\Article::TYPE}}" class="form-control" required>
                            @foreach(\App\Models\Article::POST_TYPE as $key=>$type)
                                <option value="{{$key}}">{{$type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md">
                        <label for="category">دسته بندی</label>
                        <select name="category[]" id="category" class="form-control" required multiple>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label for="tags">تگ</label>
                        <div class="d-flex">
                            <select name="tag[]" id="tag" class="form-control" required multiple>
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->title}}</option>
                                @endforeach
                            </select>
                            <button class="btn rounded" type="button" id="make">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md"></div>
                </div>

                <div class="form-group">
                    <input type="file" name="{{\App\Models\Article::IMAGE}}" id="{{\App\Models\Article::IMAGE}}" class="form-control">
                </div>

                <div class="form-group">
                    <markdown vname="{{\App\Models\Article::CONTENT}}">
                        {{old(str_replace("`","\`",\App\Models\Article::CONTENT),str_replace("`","\`",$article->content))}}
                    </markdown>
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
                    <form id="formTag" action="#" method="get">
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
                    <button type="button" class="btn btn-success" onclick="makeTag()">ثبت</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section("ex-js")
    <script>
        $("#{{\App\Models\Article::TITLE}}").val("{{old(\App\Models\Article::TITLE,$article->title)}}");
        $("#{{\App\Models\Article::TYPE}}").val("{{old(\App\Models\Article::TYPE,$article->type)}}");
        $("#{{\App\Models\Article::SLUG}}").val("{{old(\App\Models\Article::SLUG,$article->slug)}}");
        $("#category").val({!! json_encode(old("category",$article->categorize->pluck("id"))) !!}).trigger("change");
        $("#tag").val({!! json_encode(old("category",$article->tagorize->pluck("id"))) !!}).trigger("change");

        $("#make").click(function () {
            $(".modal-title").text("تگ جدید");
            $("#myModal").modal("show");
        })

        function makeTag() {
            let formData = new FormData($("#formTag")[0]);
            formData.append("salam", "1");
            $.ajax({
                url: "{{route('api.create.tag')}}",
                method: "post",
                data: formData,
                processData: false,
                contentType: false,
            }).done(function (data) {
                Swal.fire({
                    title: "پیروزی",
                    background: "#333",
                    text: "تگ مودنظر با موفقیت ایجاد شد.",
                    icon: "success",
                    toast: true,
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                });
                $("#tag").append(`<option value='${data.id}' selected>${data.title}</option>`);
                $("#myModal").modal("hide");
                $("#formTag").find("input").val("");
            })
        }
    </script>
@endsection
