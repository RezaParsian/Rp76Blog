@extends('layouts.master')

@section("ex-title",$slug->title)

@section('image',asset($slug->image))

@section('body')
    <article id="post_section" class="position-relative">
        <div class="card bg-blog shadow">
            <div class="card-body">
                <div class="big-blog-item mb-0 card-body">
                    <img src="{{asset($slug->image)}}" loading="lazy" alt="{{ $slug->title }}" class="blog-thumbnail rounded"/>
                    <div v-pre class="blog-content text-box text-white rtl text-justify">
                        <div class="top-meta ltr text-right"><label class="rtl small"><i class="fa fa-clock-o"></i> {{$slug->read_time}}</label> | <a href="{{route('profile',$slug->user->name)}}">{{ $slug->user->name }}</a> | {{ $slug->custom_date }}
                        </div>
                        <h1>{{ $slug->title }}</h1>
                        {!! $slug->markdown !!}
                    </div>
                    <hr>
                    <div class="blog-content text-box text-white rtl post-tag">
                        دسته بندی :
                        @php
                            /**
                            * @var \App\Models\Article $slug
                            */
                            $categories=[];
                            foreach ($slug->categorize as $category){
                                $categories[]="<label>{$category->title}</label>";
                            }
                        @endphp
                        {!! implode("،",$categories) !!}
                    </div>
                    <hr>
                    <div class="blog-content text-box text-white rtl post-tag">
                        @foreach($slug->tagorize as $tag)
                            <a href="#">{{$tag->title}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </article>

    {{--    <div class="card bg-blog shadow text-white rtl">--}}
    {{--        <div class="card-header">--}}
    {{--            <h6>ارسال نظر :</h6>--}}
    {{--        </div>--}}
    {{--        <div class="card-body">--}}
    {{--            <form action="" method="post">--}}
    {{--                @csrf--}}
    {{--                <div class="form-group">--}}
    {{--                    <input type="email" name="email" id="email" required class="form-control" placeholder="ایمیل">--}}
    {{--                </div>--}}

    {{--                <div class="form-group">--}}
    {{--                    <markdown vname="comment"></markdown>--}}
    {{--                </div>--}}

    {{--                <button class="btn btn-success px-4">--}}
    {{--                    ثبت نظر--}}
    {{--                </button>--}}
    {{--            </form>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
