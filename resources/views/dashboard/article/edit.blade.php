@extends("layouts.dashboard.index")

@section("ex-title","مقاله جدید")

@section("content")
    <div class="card">
        <div class="card-body">
            <form action="{{route("article.store")}}" method="post">
                @csrf
                <div class="form-group row">
                    <div class="col-md">
                        <label for="{{\App\Models\Article::TITLE}}">موضوع</label>
                        <input type="text" name="{{\App\Models\Article::TITLE}}" id="{{\App\Models\Article::TITLE}}" class="form-control" placeholder="موضوع" required>
                    </div>
                    <div class="col-md">
                        <label for="{{\App\Models\Article::SLUG}}">نامک</label>
                        <input type="text" name="{{\App\Models\Article::SLUG}}" id="{{\App\Models\Article::SLUG}}" class="form-control" placeholder="نامک" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md">
                        <label for="{{\App\Models\Article::TYPE}}">نوع پست</label>
                        <select name="{{\App\Models\Article::TYPE}}" id="{{\App\Models\Article::TYPE}}" class="form-control" required>
                            <option value="">یک نوع انتخاب کنید</option>
                            @foreach(\App\Models\Article::POST_TYPE as $key=>$type)
                                <option value="{{$key}}">{{$type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md">
                        <label for="category">دسته بندی</label>
                        <select name="category" id="category" class="form-control" required multiple>
                            <option value="">یک دسته بندی انتخاب کنید</option>
                            @foreach(\App\Models\Article::POST_TYPE as $key=>$type)
                                <option value="{{$key}}">{{$type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <input type="file" name="{{\App\Models\Article::IMAGE}}" id="{{\App\Models\Article::IMAGE}}" class="form-control">
                </div>

                <div class="form-group">
                    <markdown vname="{{\App\Models\Article::CONTENT}}"></markdown>
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

@section("ex-js")
    <script>
        $("#{{\App\Models\Article::TITLE}}").val("{{old(\App\Models\Article::TITLE,$article->title)}}");
        $("#{{\App\Models\Article::TYPE}}").val("{{old(\App\Models\Article::TYPE,$article->type)}}");
        $("#{{\App\Models\Article::SLUG}}").val("{{old(\App\Models\Article::SLUG,$article->slug)}}");
        $("#{{\App\Models\Article::CONTENT}}").val(`{!! old(str_replace("`","\`",\App\Models\Article::CONTENT),str_replace("`","\`",$article->content)) !!}`);
        {{--        $("#category").val("{{old("category",$article->category)}}");--}}
    </script>
@endsection
