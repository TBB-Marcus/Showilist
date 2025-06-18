<x-app-layout title="">
    <div class="text-textbase ml-15 mt-15">
        <h1 class="text-3xl">Welcome to your watchlist!</h1>
        <p class="">below are all the shows you have put a status on</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8 w-full ml-15 mt-15">
        @foreach($shows as $show)
            <x-show-card
                :id="$show->show_id"
                :genreIds="explode(',', $show->genre_ids)"
                :name="$show->name"
                :rating="$show->rating"
                :originalLanguage="$show->original_language"
                :releaseDate="$show->first_air_date"
                :poster="$show->poster"
                :backdrop="$show->backdrop"
            />
        @endforeach
    </div>
</x-app-layout>
