<div class="side-card pb-14">
    <div class="flex mt-12">
        @if(!auth()->user()->hasImage())
            <div class="mx-auto rounded-full border p-3">
                <x-svg.image class="w-12 h-12"></x-svg.image>
            </div>
        @else
            <img src="{{auth()->user()->image}}" alt="{{auth()->user()->name}}" class="rounded-full w-24 mx-auto">
        @endif
    </div>

    <h3 class="text-center my-2">
        {{auth()->user()->name}}
    </h3>
</div>

@stack('aside')

<div class="side-card my-6 p-4">
    <h3 class="header">منو</h3>

    <ul class="list-none">
        {!! \App\Http\Helper\Menu::instance()->render() !!}
    </ul>

    <form action="{{route('logout')}}" method="post" class="border-t mt-2 pt-1">
        @csrf
        <button class="hover:shadow duration-700 rounded-lg  text-center p-2 w-full">
            خروج
        </button>
    </form>
</div>
