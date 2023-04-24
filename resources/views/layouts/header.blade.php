<header class="bg-white dark:bg-zinc-800 shadow dark:shadow-rp-900 py-4 sticky top-0 z-50">
    <div class="container mx-auto">
        <div class="grid grid-cols-7">
            <div class="col-span-2">
                <div>
                    <a href="{{route('blog')}}" class="flex">
                        <img src="{{asset('favicon.ico')}}" alt="logo" class="w-12">

                        <span class="my-auto dark:text-white">{{config('app.name')}}</span>
                    </a>
                </div>
            </div>

            <nav class="col-span-5 pr-4">
                <div class="grid grid-cols-5">
                    <div class="col-span-3 flex my-auto gap-3 dark:text-white">
                        <div class="c_underline">
                            <a href="{{route('blog')}}" @class(['active'=>request()->is('/')])>
                                جدیدترین‌ها
                            </a>
                        </div>

                        <div class="c_underline">
                            <a href="{{route('profile','Reza Atom')}}" @class(['active'=>request()->is('profile/*')])>
                                درباره من
                            </a>
                        </div>
                    </div>

                    <div class="col-span-2 flex gap-1 mr-auto">
                        <div class="my-auto p-1" type="گیت‌هاب">
                            <a href="{{config('app.social_github')}}" target="_blank">
                                <x-svg.github></x-svg.github>
                            </a>
                        </div>

                        <div class="my-auto p-1" type="توییتر">
                            <a href="{{config('app.social_twitter')}}" target="_blank">
                                <x-svg.twitter></x-svg.twitter>
                            </a>
                        </div>

                        <div class="my-auto p-1" type="یوتیوب">
                            <a href="{{config('app.social_youtube')}}" target="_blank">
                                <x-svg.youtube></x-svg.youtube>
                            </a>
                        </div>

                        <div class="my-auto p-1" type="یوتیوب">
                            <a href="{{config('app.social_linkedin')}}" target="_blank">
                                <x-svg.linkedin></x-svg.linkedin>
                            </a>
                        </div>

                        <div id="theme" class="my-auto ml-3">
                            <div class="my-auto p-1 cursor-pointer" id="day" style="display: none" title="تم روشن">
                                <x-svg.sun></x-svg.sun>
                            </div>

                            <div class="my-auto p-1 cursor-pointer" id="night" title="تم تاریک">
                                <x-svg.moon></x-svg.moon>
                            </div>
                        </div>

                        <div class="flex my-auto mr-auto dark:text-white">
                            <a href="{{route('login')}}" class="p-2 px-0 c_underline w-f">
                                @auth()
                                    <span>{{auth()->user()->name}}</span>
                                @else
                                    <span>ورود / عضویت</span>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

        </div>
    </div>
</header>
