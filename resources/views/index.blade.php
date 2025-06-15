{{-- @php
    dd($shows);
@endphp --}}

<x-app-layout title="">

    <div class="max-w-7xl mx-auto px-4 pt-10">
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
