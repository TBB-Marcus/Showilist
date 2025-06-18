{{-- @php
    dd($shows);
@endphp --}}

<x-app-layout title="">

    @if (!Auth::check())
        <div class="m-50 grid grid-flow-row place-items-center gap-50 sm:grid-cols-1 lg:grid-cols-2">
            <div>
                <h1 class="font-bold text-3xl"><i class="fa-solid fa-list-check text-clickable mr-2"></i> Track what you watch</h1>
                <p class="pl-1">Whether you are binging, or taking your time, our watchlist will make it easy to keep everything organized.</p>
            </div>
            <div>
                <h1 class="font-bold text-3xl"><i class="fa-solid fa-star text-yellow-400 mr-2"></i> Share your opinion</h1>
                <p class="pl-1">Rate each show after watching to keep track of what you loved- or didn't. Your personal ratings help you look back at your favorites; while helping others decide what to watch!</p>
            </div>
            <div>
                <h1 class="font-bold text-3xl"><i class="fa-solid fa-lightbulb text-gray-400 mr-2"></i> Simplicity is key</h1>
                <p class="pl-1">Showilist focuses on a minimalist approach to tracking your shows. No more frustrating cluttered UIs that put a barrier between you, and your next watch</p>
            </div>
            <div>
                <a href="/auth?register"><button class="bg-gradient-to-r from-sky-400 to-blue-500 p-8 w-60 rounded-full hover:shadow-lg hover:shadow-clickable transition-all hover:scale-110 cursor-pointer"> GET STARTED </button></a>
            </div>
        </div>
    @endif

    <div class="mx-auto min-h-72 p-15">
        <h1 class="text-3xl font-bold pb-5">Popular now:</h1>
        @livewire('popular-pagnation')
    </div>

</x-app-layout>
