<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class showCard extends Component
{

    public $id;
    public $genreId;
    public $name;
    public $rating;
    public $originalLanguage;
    public $releaseDate;
    public $poster;
    public $backdrop;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $id = null,
        $genreId = null,
        $name = 'N/A',
        $rating = 0,
        $originalLanguage = 'N/A',
        $releaseDate = 'N/A',
        $poster = null,
        $backdrop = null
    ) {
        $this->id = $id;
        $this->genreId = $genreId;
        $this->name = $name;
        $this->rating = $rating;
        $this->originalLanguage = $originalLanguage;
        $this->releaseDate = $releaseDate;
        $this->poster = $poster;
        $this->backdrop = $backdrop;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.show-card');
    }
}
