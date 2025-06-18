<div class="mt-5">
    <select wire:model.live="status" class="border rounded-md w-50 h-10 text-center ml-15">
        <option value="all" selected>All</option>
        <option value="planning">Planning</option>
        <option value="watching">Watching</option>
        <option value="completed">Completed</option>
        <option value="paused">Paused</option>
        <option value="dropped">Dropped</option>
    </select>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8 p-15">
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
</div>
