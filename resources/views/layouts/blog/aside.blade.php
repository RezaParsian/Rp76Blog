<div class="side-card pb-14">
    <div class="flex mt-12">
        <img src="{{$owner->image}}" alt="{{$owner->name}}" class="rounded-full w-24 mx-auto">
    </div>

    <h3 class="text-center my-2">
        سلام، {{$owner->name}} هستم!
    </h3>

    <p class="text-justify break-words px-8 mt-4">
        در این سایت، نه تنها به نمونه‌کارهای من در زمینه برنامه‌نویسی نگاهی بیندازید، بلکه با مطالعه مقالات و آموزش‌های جذاب و جدید، نگرانی‌های خود را در این زمینه کاهش دهید.
    </p>
</div>

<div class="side-card my-6 p-4">
    <h3 class="header">مطالب تصادفی</h3>

    @foreach(\App\Models\Article::where('type','blog')->limit(5)->inRandomOrder()->get() as $article)
        <div class="grid grid-cols-3 my-4 gap-2">
            <div class="col-span-2 flex flex-col pt-4">
                <a href="{{$article->link}}" title="مطالعه مقاله">
                    <h2 class="text-sm">{{$article->title}}</h2>
                </a>

                <p class="mt-auto text-xs flex">
                    <span class="my-auto">{{ $article->custom_date }}</span>

                    <x-svg.clock class="fill-slate-400 hover:fill-slate-500"></x-svg.clock>
                </p>
            </div>

            <a href="{{$article->link}}" title="مطالعه مقاله" class="my-auto">
                <img src="{{$article->image}}" loading="lazy" alt="{{$article->title}}" class="rounded-lg bord w-24 h-24 object-cover border-2 border-slate-400" title="{{$article->title}}"/>
            </a>
        </div>
    @endforeach
</div>

<div class="side-card my-6 p-4">
    <h3 class="header">توییت ها</h3>

    @foreach($twits as $article)
        <div class="my-4 gap-2">
            <div class="col-span-2 flex flex-col">
                <p class="whitespace-pre-line">{{$article->content}}</p>

                <p class="mt-2 text-xs flex mr-auto">
                    <span dir="ltr" class="my-auto mx-1">{{ enToFn($article->created_at_p) }}</span>

                    <x-svg.clock class="fill-slate-400 hover:fill-slate-500"></x-svg.clock>
                </p>
            </div>

        </div>
    @endforeach
</div>

<div class="side-card my-6 p-4">
    <h3 class="header">دسته‌بندی ها</h3>

    <div class="px-4">
        @foreach($cats as $category)
            <div class="bg-slate-100 dark:bg-stone-900 rounded-lg p-4 my-1 justify-between flex">
                <p>{{$category['count']}} پست</p>

                <a href="#">
                    <p class="bg-rp-400/90 text-white rounded-full text-sm mr-auto w-fit px-3 py-[2px] hover:bg-slate-500 duration-700 line-clamp-1">{{$category['title']}}</p>
                </a>
            </div>
        @endforeach
    </div>
</div>

<div class="side-card my-6 p-4">
    <h3 class="header">تگ ها</h3>

    <div class="flex flex-wrap gap-2">
        @foreach($tags as $tag)
            <span class="tag">{{$tag->title}}</span>
        @endforeach
    </div>
</div>


