@if(!Auth::check())
<header class="bg-contrast p-5 ">
    <div class="grid grid-cols-3 grid-rows-1 grid-flow-col place-items-center">
        <a href="{{ route('home') }}" class="text-white text-2xl font-bold justify-self-start pl-5"><span class="text-clickable">SHOW</span>ilist</a>
        <div class="flex justify-center gap-5 w-full text-center">
            <a class="hover:text-clickable transition-all cursor-pointer">Search</a>
            <a class="hover:text-clickable transition-all cursor-pointer">Top Shows</a>
            <a class="hover:text-clickable transition-all cursor-pointer">About Us</a>
        </div>
        <a href="{{ route('home') }}" class="text-white text-2xl font-bold"><span class="text-clickable">SHOW</span>ilist</a>
    </div>
</header>
@else
<p>I still need to make the authed navbar</p>
@endif
