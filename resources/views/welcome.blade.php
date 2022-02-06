@extends('layouts.blog')

@section('body')
    <ul class="blog-filter">
        <li><a href="#">Racing</a></li>
        <li><a href="#">Shooters</a></li>
        <li><a href="#">Strategy</a></li>
        <li><a href="#">Online</a></li>
    </ul>
    <article id="post_section" class="position-relative">
        <div class="position-absolute p-0 m-0 w-100 h-100 d-flex justify-content-center">
            <div class="spinner-grow text-warning"></div>
        </div>
        {{--        <div class="rtl" v-if="posts.length==0">--}}
        {{--            <h1 class="text-center text-white">نتیجه ای یافت نشد.</h1>--}}
        {{--        </div>--}}

        @foreach($articles as $article)
            <div class="card bg-blog shadow">
                <div class="card-body">
                    <div class="big-blog-item mb-0 text-center">
                        <img src="{{$article->image}}" loading="lazy" alt="{{$article->title}}" class="blog-thumbnail rounded"/>
                        <div class="blog-content text-box text-white rtl">
                            <div class="top-meta ltr text-right"><label class="rtl small"><i class="fa fa-clock-o"></i> {{$article->read_time}}</label> | <a href="{{route('profile',$article->user->name)}}">{{ $article->user->name }}</a>
                                | {{ $article->custom_date }}</div>
                            <h3 class="m-0">{{ $article->title }}</h3>
                            <summary class="text-justify">{!! $article->summary !!}</summary>
                            <p class="mt-3"><a href="{{$article->link}}" data-toggle="tooltip" title="بیشتر" data-post="{{$article->id}}" class="read-more">بیشتر</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="site-pagination">
            {{$articles->appends(Request()->all())->links("layouts.endgame")}}

        </div>
    </article>
@endsection
