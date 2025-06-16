<div
    class="w-full h-full min-h-200"
    id="shows-container"
    x-data
    x-on:shows-loaded.window="
        const el = document.getElementById('shows-container');
        if (el) {
            const y = el.getBoundingClientRect().top + window.scrollY - 200;
            window.scrollTo({ top: y, behavior: 'smooth' });
        }
    "
>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8 w-full">
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
    <div class="flex justify-end gap-5 mt-5">
        @if($page <= 1)
            <button class="text-textbase/20" disabled>Last page</button>
        @else
            <button class="text-textbase hover:text-texthover hover:scale-102 transition-all cursor-pointer" id="lastButton" wire:click='previousPage'>Last page</button>
        @endif
        <p>{{$page}}</p>
        <button class="text-textbase hover:text-texthover hover:scale-102 transition-all cursor-pointer" id="nextButton" wire:click='nextPage'>Next page</button>
    </div>
</div>
