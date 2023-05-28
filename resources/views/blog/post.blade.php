@extends('layouts.blog.master')

@section("ex-title",$article->title)

@section('image',asset($article->image))

@section('content')
    <article class="bg-white dark:bg-stone-900 dark:text-white p-6 rounded-3xl mt-10">
        <img src="{{asset($article->image)}}" loading="lazy" alt="{{ $article->title }}" class="rounded-3xl mx-auto shadow dark:shadow-rp-100 bg-white -mt-16"/>

        <div class="grid md:grid-cols-5 my-4 gap-3 md:gap-0">
            <h1 class="col-span-4 text-base md:text-4xl order-2 md:order-1">{{ $article->title }}</h1>

            <div class="bg-rp-400/90 my-auto text-white rounded-lg text-sm mr-auto w-fit px-3 py-[2px] line-clamp-1 order-1 md:order-2" dir="ltr">
                {{@$article->category->title}}
            </div>
        </div>

        <div>
            <div class="flex pr-6 mt-auto border-b pb-3 mb-3">
                <div class="ml-2 mr-auto flex text-xs">
                    <p class="my-auto after:content-['مطالعه']">
                        {{$article->read_time}}
                    </p>

                    <i class="dot"></i>

                    <p class="my-auto">
                        {{ $article->custom_date }}
                    </p>

                    <i class="dot"></i>


                    <a href="{{route('profile',$article->user->name)}}" class="my-auto c_underline">
                        <p>{{$article->user->name}}</p>
                    </a>

                    <i class="dot"></i>

                    <img src="{{$article->user->image}}" alt="{{$article->user->name}}" class="w-8 h-8 rounded-full border-2 border-rp-400">
                </div>
            </div>
        </div>

        <div id="moreDetail" class="leading-7 hyphens-manual">
            {!! $article->markdown !!}
        </div>

        <div class="border-t flex flex-wrap gap-2 pt-4 mt-4">
            @foreach($article->tags as $tag)
                <a href="{{route('post.by.tag',$tag->slug)}}">
                    <p class="tag dark:bg-stone-800">{{$tag->title}}</p>
                </a>
            @endforeach
        </div>
    </article>

    <section class="grid md:grid-cols-2 md:gap-6 mt-6">
        @if($nextPost)
            <a href="{{$nextPost->link}}" title="مقاله بعدی">
                <div class="grid grid-cols-3 my-4 gap-2 bg-white dark:bg-stone-900 dark:text-white rounded-3xl p-4">
                    <div class="col-span-2 flex flex-col pt-4">
                        <h2 class="text-sm">{{$nextPost->title}}</h2>

                        <span class="flex mt-auto text-sm gap-2">
                        <x-svg.forward-arrow></x-svg.forward-arrow>

                        <span>مقاله بعدی</span>
                   </span>
                    </div>

                    <img src="{{$nextPost->image}}" loading="lazy" alt="{{$nextPost->title}}" class="rounded-lg bord w-24 h-24 object-cover border-2 border-slate-400" title="{{$nextPost->title}}"/>
                </div>
            </a>
        @else
            <div></div>
        @endif

        @if($prevPost)
            <a href="{{$prevPost->link}}" title="مقاله قبلی">
                <div class="grid grid-cols-3 my-4 gap-2 bg-white dark:bg-stone-900 dark:text-white rounded-3xl p-4">
                    <img src="{{$prevPost->image}}" loading="lazy" alt="{{$prevPost->title}}" class="rounded-lg bord w-24 h-24 object-cover border-2 border-slate-400" title="{{$prevPost->title}}"/>

                    <div class="col-span-2 flex flex-col pt-4 text-left">
                        <h2 class="text-sm">{{$prevPost->title}}</h2>

                        <span class="flex text-sm mt-auto gap-2 mr-auto">
                        <span>مقاله قبلی</span>

                        <x-svg.backward-arrow></x-svg.backward-arrow>
                    </span>
                    </div>
                </div>
            </a>
        @else
            <div></div>
        @endif
    </section>
@endsection
