@if(!Auth::check())
<header class="bg-contrast p-5 shadow-xl">
    <div class="grid grid-cols-3 grid-rows-1 grid-flow-col place-items-center">
        <a href="{{ route('home') }}" class="text-white text-2xl font-bold justify-self-start pl-5 hover:scale-105 transition-all"><span class="text-clickable">SHOW</span>ilist</a>
        <div class="flex justify-center gap-5 w-full text-center">
            <a href="/search" class="text-textbase hover:text-white transition-all cursor-pointer hover:scale-105">Search</a>
            <a href="" class="text-textbase hover:text-white transition-all cursor-pointer hover:scale-105">Top Shows</a>
            <a href="" class="text-textbase hover:text-white transition-all cursor-pointer hover:scale-105">About Us</a>
        </div>
        <div class="flex gap-5 justify-self-end pr-5">
            <a href="/auth?login" class="p-2 text-textbase hover:text-white transition all cursor-pointer hover:scale-105">Login</a>
            <a href="/auth?register" class="p-2 p-md-5 rounded-xl hover:bg-clickable bg-clickable-hover text-white transition-all hover:scale-105">Sign Up</a>
        </div>
    </div>
</header>
@else
<header class="bg-contrast p-5 shadow-xl">
    <div class="grid grid-cols-3 grid-rows-1 grid-flow-col place-items-center">
        <a href="{{ route('home') }}" class="text-white text-2xl font-bold justify-self-start pl-5 hover:scale-105 transition-all"><span class="text-clickable">SHOW</span>ilist</a>
        <div class="flex justify-center gap-5 w-full text-center">
            <a href="/search" class="text-textbase hover:text-white transition-all cursor-pointer hover:scale-105">Search</a>
            <a href="" class="text-textbase hover:text-white transition-all cursor-pointer hover:scale-105">My List</a>
            <a href="" class="text-textbase hover:text-white transition-all cursor-pointer hover:scale-105">My Reviews</a>
        </div>
        <div class="flex gap-5 justify-self-end pr-5">
            <a href="/logout" class="p-2 text-textbase hover:text-white transition all cursor-pointer hover:scale-105">Log out</a>
        </div>
    </div>
</header>
@endif
