<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Show;

class WatchlistButton extends Component
{

    public $showId;
    public $status;
    public $statuses = [
        'planning' => 'Planning',
        'watching' => 'Watching',
        'completed' => 'Completed',
        'paused' => 'Paused',
        'dropped' => 'Dropped',
    ];

    public $show;

    /**
     * Mount the component with initial data.
     * This retrieves the user's favorite status for the show, if any.
     */
    public function mount($showId)
    {
        $this->showId = $showId;

        $favorite = Favorite::where('user_id', Auth::id())
            ->where('show_id', $this->showId)
            ->first();

        $this->status = $favorite->status ?? '';
    }

    /**
     * Runs automatically when the user selects a new status.
     * If the user selects 'remove', it deletes the favorite entry.
     */
    public function updatedStatus($value)
    {
        if ($value === 'remove') {
            Favorite::where('user_id', Auth::id())
                ->where('show_id', $this->showId)
                ->delete();

            $this->status = '';
            $this->dispatch('$refresh');
            $this->cacheShow();
            return;
        }

        Favorite::updateOrCreate(
            ['user_id' => Auth::id(), 'show_id' => $this->showId],
            ['status' => $value]
        );

        $this->dispatch('$refresh');
        $this->cacheShow();
    }

    /**
     * This is the method that caches the show details in the database
     * when the user adds a show to their watchlist.
     * the reason i do this is because the API does not provide a way to retrieve the show details in bulk
     * and I want to avoid N+1 queries when retrieving the watchlist later.
     */
    public function cacheShow() // I have to cache the show upon adding to list to avoid N+1 queries upon retrieving the watchlist later
    {                           // this is probably not the best solution, but the API does not provide a way to retrieve the show details in bulk
        $show = Show::where('show_id', $this->showId)->first();
        if (!$show) {
            Show::create([
                'show_id' => $this->showId,
                'genre_ids' => implode(',', array_column($this->show->genres, 'id')),
                'name' => $this->show->name,
                'rating' => $this->show->vote_average,
                'original_language' => $this->show->original_language,
                'release_date' => $this->show->first_air_date,
                'poster' => $this->show->poster_path,
                'backdrop' => $this->show->backdrop_path,
            ])->save();
        }
    }

    public function render()
    {
        return view('livewire.watchlist-button');
    }
}
