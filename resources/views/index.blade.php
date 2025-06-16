{{-- @php
    dd($shows);
@endphp --}}

<x-app-layout title="">

    @if (!Auth::check())
        <div class="p-50 grid grid-cols-2 grid-flow-row place-items-center gap-50">
            <div>
                <h1 class="font-bold text-3xl"><i class="fa-solid fa-list-check text-clickable mr-2"></i> Track what you watch</h1>
                <p>Whether you are binging, or spacing it out, our watchlist will make it easy to keep everything organized.</p>
            </div>
            <div>
                <h1 class="font-bold text-3xl"><i class="fa-solid fa-star text-yellow-400 mr-2"></i> Share your opinions</h1>
                <p>Rate each show after watching to keep track of what you loved- or didn't. Your personal ratings help you look back at your favorites</p>
            </div>
            <div>
                <h1 class="font-bold text-3xl"><i class="fa-solid fa-lightbulb text-gray-400 mr-2"></i> Simplicity is key</h1>
                <p>Showilist focuses on a minimalist approach to tracking your shows. No more frustrating cluttered UIs that put a barrier between you, and your next watch</p>
            </div>
            <div>
                <button class="bg-gradient-to-r from-sky-400 to-sky-700 p-8 w-60 rounded-full hover:shadow-lg hover:shadow-clickable transition-all hover:scale-110 cursor-pointer"> GET STARTED </button>
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 pt-10">
        <h1 class="text-3xl font-bold pb-5">Popular now:</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
            @foreach($shows as $show)
                <x-show-card
                    :id="$show->id"
                    :genreIds="$show->genre_ids"
                    :name="$show->name"
                    :rating="$show->vote_average"
                    :originalLanguage="$show->original_language"
                    :releaseDate="$show->first_air_date"
                    :poster="$show->poster_path"
                    :backdrop="$show->backdrop_path"
                />
            @endforeach
        </div>
    </div>

</x-app-layout>
