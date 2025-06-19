<?php

namespace App\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;

class PopularPagnation extends Component
{

    public $shows;
    public $page = 1;

    /**
     * Mount the component with initial data.
     * This being page 1 of the trending TV shows.
     */
    public function mount()
    {
        $client = new Client();

        $response = $client->get(env('TMDB_URL') . 'trending/tv/week', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('TMDB_READ_ACCESS_TOKEN')
            ],
        ]);
        $shows = json_decode($response->getBody());
        $shows = $shows->results;
        $this->shows = $shows;
    }

    /**
     * Load the next page of shows
     */
    public function nextPage()
    {
        $this->page++;
        $this->loadShows();
        $this->dispatch('shows-loaded');
    }

    /**
     * Load the previous page of shows
     * Only decrements the page if it is greater than 1
     * To prevent going to a non-existent page.
     */
    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page--;
            $this->loadShows();
            $this->dispatch('shows-loaded');
        }
    }

    /**
     * Load shows from the TMDB API based on the current page.
     */
    public function loadShows()
    {
        $client = new Client();

        $response = $client->get(env('TMDB_URL') . 'trending/tv/week', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('TMDB_READ_ACCESS_TOKEN')
            ],
            'query' => [
                'page' => $this->page,
            ]
        ]);
        $shows = json_decode($response->getBody());
        $this->shows = $shows->results;
    }

    public function render()
    {
        return view('livewire.popular-pagnation');
    }
}
