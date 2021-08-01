@extends('layouts.blog')

@section('body')
    <article @mouseover="HoverToolTip" id="post_section" class="position-relative">
        <div class="card bg-blog shadow">
            <div class="card-body">
                <div class="big-blog-item mb-0">
                    <img src="{{asset("img/blog-big/1.jpg")}}" alt="image" class="blog-thumbnail rounded"/>
                    <div class="blog-content text-box text-white rtl">
                        <div class="top-meta">{{ $slug->custom_date }} / By <a href="">{{ $slug->user->name }}</a></div>
                        <h3>{{ $slug->title }}</h3>
                        {!! $slug->markdown !!}
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
