<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class Rating extends Component
{

    public $showId;
    public $rating;
    public $review;
    public $range = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

    public function mount()
    {
        $this->rating = Review::where('user_id', Auth::id())
            ->where('show_id', $this->showId)
            ->value('rating') ?? 0;
    }

    public function updatedReview($value)
    {
        $this->rating = $value;

        $review = Review::where('user_id', Auth::id())
            ->where('show_id', $this->showId)
            ->first();

        if (!$review) {
            Review::create([
                'user_id' => Auth::id(),
                'show_id' => $this->showId,
                'rating' => $this->rating,
            ]);
        }
        else {
            if($this->rating == 0) {
                $review->delete();
                return;
            }
            $review->update(['rating' => $this->rating]);
        }
    }

    public function render()
    {
        return view('livewire.rating');
    }
}
