<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Favorite;
use App\Models\Show;
use Illuminate\Support\Facades\Auth;

class Statussort extends Component
{

    public $shows;
    public $status = 'all';

    /**
     * Mount the component with initial data.
     * Retreieves users favorite shows by ID and fetches the corresponding shows from the database
     * The database acts like a cache for the shows because there is no api endpoint to get shows in bulk by ID
     */
    public function mount()
    {
        $favoriteShowIds = Favorite::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->pluck('show_id')
        ->toArray();

        $this->shows = Show::whereIn('show_id', $favoriteShowIds)->get();
    }

    /**
     * Only retrieves the shows that match the given status
     * @param string $status the status to filter by
     */
    public function sortByStatus($status)
    {
        $favoriteShowIds = Favorite::where('user_id', Auth::id())
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->pluck('show_id')
            ->toArray();
        $this->shows = Show::whereIn('show_id', $favoriteShowIds)->get();
    }

    /**
     * Updates the status and retrieves the shows that match the given status
     * If the status is 'all', it retrieves all shows
     * @param string $value the new status to filter by
     */
    public function updatedStatus($value)
    {
        $this->status = $value;
        if($this->status === 'all') {
            $this->mount();
            return;
        }
        $this->sortByStatus($this->status);
    }


    public function render()
    {
        return view('livewire.statussort');
    }
}
