<div class="container mx-auto">
    <div class="flex md:hidden justify-between px-4">
        <div class="my-auto p-3" id="phone_menu_button">
            <x-svg.menu class="w-6 h-6"></x-svg.menu>
        </div>

        <div id="theme" class="my-auto">
            <div class="my-auto p-1 cursor-pointer day" style="display: none" title="تم روشن">
                <x-svg.sun class="w-6 h-6"></x-svg.sun>
            </div>

            <div class="my-auto p-1 cursor-pointer night" title="تم تاریک">
                <x-svg.moon class="w-6 h-6"></x-svg.moon>
            </div>
        </div>

        <a href="{{route('blog')}}" class="flex">
            <img src="{{asset('favicon.ico')}}" alt="logo" class="w-12">
        </a>
    </div>

    <div class="bg-slate-100 dark:bg-stone-900 mt-4 mx-6 rounded p-3 md:hidden" id="phone_menu" style="display: none">
        <div class="col-span-3 my-auto mr-6 dark:text-white flex-col flex gap-2">
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

        <div class="col-span-2 flex gap-1 mr-auto mt-3 border-y py-3 justify-between">
            <div class="my-auto p-3" type="گیت‌هاب">
                <a href="{{config('app.social_github')}}" target="_blank">
                    <x-svg.github class="w-6 h-6"></x-svg.github>
                </a>
            </div>

            <div class="my-auto p-3" type="توییتر">
                <a href="{{config('app.social_twitter')}}" target="_blank">
                    <x-svg.twitter class="w-6 h-6"></x-svg.twitter>
                </a>
            </div>

            <div class="my-auto p-3" type="یوتیوب">
                <a href="{{config('app.social_youtube')}}" target="_blank">
                    <x-svg.youtube class="w-6 h-6"></x-svg.youtube>
                </a>
            </div>

            <div class="my-auto p-3" type="لینکدین">
                <a href="{{config('app.social_linkedin')}}" target="_blank">
                    <x-svg.linkedin class="w-6 h-6"></x-svg.linkedin>
                </a>
            </div>
        </div>

        <form class="my-4 border-b pb-4">
            <label class="flex border border-rp-300 rounded">
                <input type="text" name="q" id="searchBox" class="!border-0 focus:!ring-0 !shadow-none !bg-slate-100" value="{{request()->input('q')}}" placeholder="جستجو...">

                <button class="p-2 px-4">
                    <x-svg.search></x-svg.search>
                </button>
            </label>
        </form>

        <div class="flex my-auto mr-auto dark:text-white justify-center">
            <a href="{{route('login')}}" class="p-2 px-0 c_underline w-f">
                @auth()
                    <span>{{auth()->user()->name}}</span>
                @else
                    <span>ورود / عضویت</span>
                @endif
            </a>
        </div>
    </div>

    <div class="md:grid grid-cols-7 hidden">
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

                <div class="col-span-2 flex gap-1 mr-auto relative">
                    <button class="p-2 px-4" id="searchBarButton">
                        <x-svg.search></x-svg.search>
                    </button>

                    <form class="absolute bg-slate-100 left-0 right-0 top-10" id="searchBar" style="display: none" action="{{request()->is('*post*') ? '/' : ''}}">
                        <label class="flex border border-rp-300 rounded">
                            <input type="text" name="q" id="searchBox" class="!border-0 focus:!ring-0 !shadow-none !bg-slate-100" value="{{request()->input('q')}}" placeholder="جستجو...">

                            <button class="p-2 px-4">
                                <x-svg.search></x-svg.search>
                            </button>
                        </label>
                    </form>

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
                        <div class="my-auto p-1 cursor-pointer day" style="display: none" title="تم روشن">
                            <x-svg.sun></x-svg.sun>
                        </div>

                        <div class="my-auto p-1 cursor-pointer night" title="تم تاریک">
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
