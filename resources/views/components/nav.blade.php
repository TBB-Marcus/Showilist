<header class="bg-contrast p-5 shadow-xl" x-data="{ open: false }">
    <div class="grid grid-cols-3 place-items-center">
        <a href="{{ route('home') }}" class="text-white text-2xl font-bold justify-self-start pl-2 hover:scale-105 transition-all">
            <span class="text-clickable">SHOW</span>ilist
        </a>

        <div class="hidden md:flex justify-center gap-5 w-full text-center">
            <a href="/search" class="text-textbase hover:text-white transition-all cursor-pointer hover:scale-105">Search</a>
            @if(Auth::check())
                <a href="/watchlist" class="text-textbase hover:text-white transition-all cursor-pointer hover:scale-105">My List</a>
            @else
                <a href="/" class="text-textbase hover:text-white transition-all cursor-pointer hover:scale-105">Top Shows</a>
            @endif
            <a href="/" class="text-textbase hover:text-white transition-all cursor-pointer hover:scale-105">Home</a>
        </div>

        <div class="hidden md:flex gap-5 justify-self-end pr-2">
            @if(!Auth::check())
                <a href="/auth?login" class="p-2 text-textbase hover:text-white transition-all cursor-pointer hover:scale-105">Login</a>
                <a href="/auth?register" class="p-2 rounded-xl hover:bg-clickable bg-clickable-hover text-white transition-all hover:scale-105">Sign Up</a>
            @else
                <a href="/logout" class="p-2 text-textbase hover:text-white transition-all cursor-pointer hover:scale-105">Log out</a>
            @endif
        </div>

        <!-- Fikk Hjelp av ChatGPT for å lage hamburgermeny -->
        <button @click="open = !open" class="md:hidden col-start-3 justify-self-end text-white pr-2">
            <i class="fa-solid fa-bars text-2xl"></i>
        </button>
    </div>


    <!-- Fikk Hjelp av ChatGPT for å lage hamburgermeny -->
    <div x-show="open" x-transition class="md:hidden mt-4 flex flex-col gap-3 text-center">
        <a href="/search" class="text-textbase hover:text-white transition-all">Search</a>
        @if(Auth::check())
            <a href="/watchlist" class="text-textbase hover:text-white transition-all">My List</a>
        @else
            <a href="/" class="text-textbase hover:text-white transition-all">Top Shows</a>
        @endif
        <a href="/" class="text-textbase hover:text-white transition-all">Home</a>

        @if(!Auth::check())
            <a href="/auth?login" class="text-textbase hover:text-white transition-all">Login</a>
            <a href="/auth?register" class="bg-clickable hover:bg-clickable-hover text-white py-2 px-4 rounded-xl">Sign Up</a>
        @else
            <a href="/logout" class="text-textbase hover:text-white transition-all">Log out</a>
        @endif
    </div>
</header>
