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

    public function mount()
    {
        $favoriteShowIds = Favorite::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->pluck('show_id')
        ->toArray();

        $this->shows = Show::whereIn('show_id', $favoriteShowIds)->get();
    }

    public function sortByStatus($status)
    {
        $favoriteShowIds = Favorite::where('user_id', Auth::id())
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->pluck('show_id')
            ->toArray();
        $this->shows = Show::whereIn('show_id', $favoriteShowIds)->get();
    }

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
