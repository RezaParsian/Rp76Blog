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
