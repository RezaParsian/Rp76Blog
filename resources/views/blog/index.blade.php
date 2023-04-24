@extends('layouts.master')

@section('content')
    @foreach($articles as $article)
        <article class="bg-white dark:bg-stone-900 dark:text-white rounded-3xl flex flex-col md:grid md:grid-cols-3 py-6 group gap-3 mb-8 hover:shadow-xl duration-700">
            <div class="col-span-2 flex flex-col order-2 md:order-1">
                <div class="md:pr-6 px-3">
                    <div class="m-0 grid md:grid-cols-5 mb-auto -mt-2">
                        <a href="{{$article->link}}" title="مطالعه مقاله" class="col-span-4 order-2 md:order-1">
                            <h2 class="mb-3 md:my-0">{{ $article->title }}</h2>
                        </a>

                        <div class="bg-rp-400/90 my-2 md:my-auto text-white rounded-lg text-sm mr-auto w-fit px-3 py-[2px] line-clamp-1 order-1 md:order-2">
                            نکات برنامه نویسی
                        </div>
                    </div>

                    <summary class="text-justify text-stone-700 dark:text-stone-400 my-6 line-clamp-3">
                        {!! $article->summary !!}
                    </summary>
                </div>

                <div class="flex md:pr-6 mt-auto">
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
                            <p>Atom {{$article->user->name}}</p>
                        </a>

                        <i class="dot"></i>

                        <img src="{{asset('upload/profile/'.$article->user->image)}}" alt="{{$article->user->name}}" class="w-8 h-8 rounded-full border-2 border-rp-400">
                    </div>
                </div>

            </div>

            <a href="{{$article->link}}" title="مطالعه مقاله" class="my-auto drop-shadow-lg order-1 md:order-2">
                <div class="overflow-hidden rounded-lg md:-ml-10 -mt-10 md:-mt-0 bg-white w-[19rem] h-[11rem] mx-auto">
                    <img src="{{$article->image}}" loading="lazy" alt="{{$article->title}}" class="w-[19rem] h-[11rem] group-hover:scale-150 duration-[2000ms]" title="{{$article->title}}"/>
                </div>
            </a>
        </article>
    @endforeach

    <div dir="ltr">
        {{$articles->links('layouts.paginate')}}
    </div>
@endsection
