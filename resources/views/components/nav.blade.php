@if(!Auth::check())
<header class="bg-contrast p-5 shadow-xl">
    <div class="grid grid-cols-3 grid-rows-1 grid-flow-col place-items-center">
        <a href="{{ route('home') }}" class="text-white text-2xl font-bold justify-self-start pl-5"><span class="text-clickable">SHOW</span>ilist</a>
        <div class="flex justify-center gap-5 w-full text-center">
            <a class="text-textbase hover:text-white transition-all cursor-pointer">Search</a>
            <a class="text-textbase hover:text-white transition-all cursor-pointer">Top Shows</a>
            <a class="text-textbase hover:text-white transition-all cursor-pointer">About Us</a>
        </div>
        <div class="flex gap-5 justify-self-end pr-5">
            <a href="" class="p-2 text-textbase hover:text-white transition all cursor-pointer">Login</a>
            <a href="" class="p-2 p-md-5 rounded-md hover:bg-clickable bg-clickable-hover text-white transition-all">Sign Up</a>
        </div>
    </div>
</header>
@else
<p>I still need to make the authed navbar</p>
@endif
